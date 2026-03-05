<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Configuration;
use Brevo\Client\Model\SendSmtpEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Mailjet\Client;
use Mailjet\Resources;
use Illuminate\Support\Facades\Log;

class MailerSend extends Controller
{
    public function brevo(Request $request)
    {
        Log::info('Request data for /send_brevo:', $request->all());
        Log::info('Request content type:', ['content_type' => $request->header('Content-Type')]);
        Log::info('Raw request body:', ['body' => $request->getContent()]);

        // Try to get data from both request() helper and Request object
        $to = $request->input('to') ?? request('to');
        $subject = $request->input('subject') ?? request('subject');
        $message = $request->input('message')
            ?? $request->input('meesage')
            ?? request('message')
            ?? request('meesage');
        $sender = $request->input('sender') ?? request('sender');

        // If all parameters are null, try to manually parse JSON
        if (is_null($to) && is_null($subject) && is_null($message) && is_null($sender)) {
            $rawBody = $request->getContent();
            Log::info('Attempting manual JSON parsing due to null parameters');
            
            if (!empty($rawBody)) {
                // First, try to clean up control characters that cause JSON parsing issues
                $cleanedBody = trim($rawBody);
                
                // Remove control characters except for necessary ones (tabs, newlines, carriage returns)
                $cleanedBody = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $cleanedBody);
                
                // Remove trailing commas before closing braces/brackets
                $cleanedBody = preg_replace('/,(\s*[}\]])/', '$1', $cleanedBody);
                
                // Ensure the JSON ends properly
                if (!str_ends_with(trim($cleanedBody), '}')) {
                    $cleanedBody = rtrim($cleanedBody, ',') . '}';
                }
                
                Log::info('Cleaned JSON body:', ['cleaned_body' => substr($cleanedBody, 0, 500) . '...']);
                
                $jsonData = json_decode($cleanedBody, true);
                
                if (json_last_error() === JSON_ERROR_NONE && is_array($jsonData)) {
                    $to = $jsonData['to'] ?? null;
                    $subject = $jsonData['subject'] ?? null;
                    $message = $jsonData['message'] ?? $jsonData['meesage'] ?? null;
                    $sender = $jsonData['sender'] ?? null;
                    Log::info('Successfully parsed JSON manually', [
                        'parsed_keys' => array_keys($jsonData)
                    ]);
                } else {
                    Log::error('Failed to parse JSON manually', [
                        'json_error' => json_last_error_msg(),
                        'json_error_code' => json_last_error()
                    ]);
                    
                    // Try alternative parsing - extract values using regex as fallback
                    Log::info('Attempting regex-based parsing as fallback');
                    
                    // Extract 'to' array - improved regex with multiline support
                    if (preg_match('/"to":\s*\[(.*?)\]/s', $cleanedBody, $matches)) {
                        $toMatches = [];
                        // Extract all email addresses from the array content
                        if (preg_match_all('/"([^"]+@[^"]+)"/', $matches[1], $toMatches)) {
                            $to = $toMatches[1];
                            Log::info('Extracted emails from to array:', ['emails' => $to]);
                        }
                    }
                    
                    // Extract other fields
                    if (preg_match('/"sender":\s*"([^"]*)"/', $cleanedBody, $matches)) {
                        $sender = $matches[1];
                    }
                    
                    if (preg_match('/"subject":\s*"([^"]*)"/', $cleanedBody, $matches)) {
                        $subject = $matches[1];
                    }
                    
                    // Extract message (more complex due to HTML content)
                    if (preg_match('/"(?:message|meesage)":\s*"(.+?)"(?:\s*[,}])/s', $cleanedBody, $matches)) {
                        $message = $matches[1];
                        // Unescape the content
                        $message = str_replace(['\\"', "\\'", '\\\\'], ['"', "'", '\\'], $message);
                    } else {
                        // Try alternative message extraction for cases with problematic quotes
                        if (preg_match('/"(?:message|meesage)":\s*"(.+?)"\s*(?:[,}]|$)/s', $cleanedBody, $matches)) {
                            $message = $matches[1];
                            // Clean up escaped content
                            $message = str_replace(['\\"', "\\'", '\\\\'], ['"', "'", '\\'], $message);
                            // Remove leading single quote if it exists
                            if (str_starts_with($message, "'")) {
                                $message = substr($message, 1);
                            }
                        }
                    }
                    
                    if ($to || $subject || $message || $sender) {
                        Log::info('Successfully extracted data using regex fallback', [
                            'to_found' => !empty($to),
                            'to_count' => is_array($to) ? count($to) : 0,
                            'subject_found' => !empty($subject),
                            'message_found' => !empty($message),
                            'sender_found' => !empty($sender)
                        ]);
                    }
                }
            }
        }

        // Debug what we received
        Log::info('Parsed request data:', [
            'to' => $to,
            'to_type' => gettype($to),
            'subject' => $subject,
            'message' => substr($message ?? '', 0, 100) . '...', // Log first 100 chars
            'sender' => $sender
        ]);

        // Handle case where 'to' might be a JSON string
        if (is_string($to)) {
            $decodedTo = json_decode($to, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decodedTo)) {
                $to = $decodedTo;
                Log::info('Successfully decoded "to" parameter from JSON string to array');
            }
        }

        // Validate inputs with more robust checking
        if (empty($to) || !is_array($to)) {
            Log::error('Validation failed for "to" parameter.', [
                'to_parameter' => $to,
                'to_type' => gettype($to),
                'is_array' => is_array($to),
                'is_empty' => empty($to)
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'No valid email addresses provided',
                'debug' => [
                    'received_to' => $to,
                    'type' => gettype($to),
                    'is_array' => is_array($to)
                ]
            ], 400);
        }

        // Validate each email in the array
        $validEmails = [];
        foreach ($to as $email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validEmails[] = $email;
            } else {
                Log::warning('Invalid email address found:', ['email' => $email]);
            }
        }

        if (empty($validEmails)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No valid email addresses found in the provided list'
            ], 400);
        }

        // Add additional message validation
        if (empty($message) || !is_string($message)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid message content'
            ], 400);
        }

        // Preserve the original HTML payload exactly as received.
        // Stripping tags breaks table-based email templates and inlined CSS.
        $emailHtml = $message;

        $delayBetweenBatches = 15; // seconds
        $countPerTime = 30;

        $batchNumber = 0;
        $dispatchedJobsCount = 0;

        foreach (array_chunk($validEmails, $countPerTime) as $emailBatch) {
            $delay = now()->addSeconds($delayBetweenBatches * $batchNumber);

            foreach ($emailBatch as $email) {
                SendEmailJob::dispatch($email, $subject, $emailHtml, $sender)->delay($delay);
                $dispatchedJobsCount++;
            }

            $batchNumber++;
        }

        Log::info('Successfully queued emails:', [
            'total_emails' => count($validEmails),
            'dispatched_jobs' => $dispatchedJobsCount
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Emails queued for sending',
            'dispatched_jobs_count' => $dispatchedJobsCount,
            'valid_emails_count' => count($validEmails)
        ]);
    }

    private function sendEmailToRecipient($recipient, $apiInstance){
        $subject = request('subject');
        $message = request('message');
        $sender = request('sender');
        //dd($message);
        $sendSmtpEmails = new SendSmtpEmail([
            'sender' => ['name' => $sender, 'email' => env('SENDER_EMAIL', 'orders@outletmartuk.store')],
            'to' => [['email' => $recipient]],
            'subject' => $subject,
            'htmlContent' => $message,
        ]);

        //dd($sendSmtpEmails);

        try {
            // Send batch of emails
            $results = $apiInstance->sendTransacEmail($sendSmtpEmails);
            return $results;
        } catch (Exception $e) {
            echo 'Exception when calling TransactionalEmailsApi->sendBatchEmails: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function mailjet(){
        $apikey = env('MAILJET_API_KEY');
        $apisecret = env('MAILJET_API_SECRET');
        //$mj = new Client($apikey, $apisecret);
        $mj = new Client($apikey,$apisecret,true,['version' => 'v3.1']);

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => env('SENDER_EMAIL', 'orders@outletmartuk.store'),
                        'Name' => "OSUK"
                    ],
                    'To' => [
                        [
                            'Email' => env('DEFAULT_RECIPIENT_EMAIL', 'wtoalabi@gmail.com'),
                            'Name' => "You"
                        ]
                    ],
                    'Subject' => "My first Mailjet Email!",
                    'TextPart' => "Greetings from Mailjet!",
                    'HTMLPart' => "<h3>Dear passenger 1, welcome to <a href=\"https://www.mailjet.com/\">Mailjet</a>!</h3>
            <br />May the delivery force be with you!"
                ]
            ]
        ];

        $response = $mj->post(Resources::$Email, ['body' => $body]);
        dd($response);
    }
}
