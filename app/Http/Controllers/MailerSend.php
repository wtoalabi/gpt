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

class MailerSend extends Controller
{
    public function brevo()
    {
        // Get the raw request body and parse it manually to handle large or malformed JSON
        $rawContent = file_get_contents('php://input');
        $decodedData = json_decode($rawContent, true);
        $jsonError = json_last_error();
        
        // If JSON is malformed, extract data using regex
        if ($jsonError !== JSON_ERROR_NONE) {
            // Extract sender
            preg_match('/"sender"\s*:\s*"([^"]+)"/', $rawContent, $senderMatches);
            $sender = $senderMatches[1] ?? null;
            
            // Extract subject
            preg_match('/"subject"\s*:\s*"([^"]+)"/', $rawContent, $subjectMatches);
            $subject = $subjectMatches[1] ?? null;
            
            // Extract message - handling HTML content
            preg_match('/"message"\s*:\s*"(.*?)"\s*,\s*"to"/', $rawContent, $messageMatches);
            $message = $messageMatches[1] ?? null;
            if ($message) {
                // Unescape the escaped quotes and slashes
                $message = stripcslashes($message);
            }
            
            // Extract to array
            preg_match('/"to"\s*:\s*\[(.+?)\]/', $rawContent, $toMatches);
            $toStr = $toMatches[1] ?? '';
            if ($toStr) {
                preg_match_all('/"([^"]+)"/', $toStr, $emailMatches);
                $to = $emailMatches[1] ?? [];
            } else {
                $to = [];
            }
        } else {
            // Use the decoded data if available
            $to = $decodedData['to'] ?? [];
            $subject = $decodedData['subject'] ?? null;
            $message = $decodedData['message'] ?? null;
            $sender = $decodedData['sender'] ?? null;
        }

        // Ensure $to is always an array
        if (!is_array($to)) {
            if (is_string($to)) {
                // If it's a comma-separated string, convert to array
                $to = array_map('trim', explode(',', $to));
            } else {
                $to = [];
            }
        }
        
        // Filter out any empty values
        $to = array_filter($to, function($email) {
            return !empty($email);
        });
        
        // Validate the array
        if (empty($to)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No valid email addresses provided'
            ], 400);
        }

        // Add additional message validation
        if (empty($message) || !is_string($message)) {
            \Illuminate\Support\Facades\Log::error('Invalid message content', ['message' => $message, 'type' => gettype($message)]);
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid message content'
            ], 400);
        }

        // Log the original message
        \Illuminate\Support\Facades\Log::debug('Original message', ['message' => $message]);
        
        // Sanitize and prepare message content for the API
        // 1. Strip tags but allow basic HTML formatting
        $sanitizedMessage = strip_tags($message, '<div><p><a><i><b><strong><em>');
        // 2. Compress whitespace to ensure it works with the API
        $sanitizedMessage = preg_replace('/\s+/', ' ', $sanitizedMessage);
        $sanitizedMessage = trim($sanitizedMessage);
        
        // Log the sanitized message
        \Illuminate\Support\Facades\Log::debug('Sanitized message', ['message' => $sanitizedMessage]);

        $delayBetweenBatches = 30; // seconds
        $countPerTime = 10;

        $batchNumber = 0;
        $dispatchedJobsCount = 0;

        foreach (array_chunk($to, $countPerTime) as $emailBatch) {
            $delay = now()->addSeconds($delayBetweenBatches * $batchNumber);

            foreach ($emailBatch as $email) {
                SendEmailJob::dispatch($email, $subject, $sanitizedMessage, $sender)->delay($delay);
                $dispatchedJobsCount++;
            }

            $batchNumber++;
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Emails queued for sending',
            'dispatched_jobs_count' => $dispatchedJobsCount,
        ]);
    }

    private function sendEmailToRecipient($recipient, $apiInstance){
        $subject = request('subject');
        $message = request('message');
        $sender = request('sender');
        //dd($message);
        $sendSmtpEmails = new SendSmtpEmail([
            'sender' => ['name' => $sender, 'email' => 'orders@outletmartuk.store'],
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
        $mj = new Client($apikey, $apisecret, true, ['version' => 'v3.1']);

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "orders@outletmartuk.store",
                        'Name' => "OSUK"
                    ],
                    'To' => [
                        [
                            'Email' => "wtoalabi@gmail.com",
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
