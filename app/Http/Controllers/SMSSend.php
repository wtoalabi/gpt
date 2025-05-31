<?php

namespace App\Http\Controllers;

use App\Jobs\SendSMSJob;
use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Configuration;
use Brevo\Client\Model\SendSmtpEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Mailjet\Client;
use Mailjet\Resources;

class SMSSend extends Controller
{
    public function bulkSMS(){

        $to = request('to');
        $from = request('from');
        $body = request('body');
        //dd([$to,$from,$body]);
        //dd(request()->all());
        $delayBetweenBatches = 30; // seconds
        $countPerTime = 10;

        $batchNumber = 0;

        foreach (array_chunk($to, $countPerTime) as $numberBatch) {
            $delay = now()->addSeconds($delayBetweenBatches * $batchNumber);
            foreach ($numberBatch as $number) {
                SendSMSJob::dispatch($number, $from, $body)->delay($delay);
            }
            $batchNumber++;
        }

        $dispatchedJobsCount = count($to);
        $queuedJobsCount = count(collect($to)->chunk($countPerTime)->flatten());

        return response()->json([
            'status' => 'SMS queued for testing',
            'dispatched_jobs_count' => $dispatchedJobsCount,
            'queued_jobs_count' => $queuedJobsCount,
        ]);


        return response()->json(['status' => 'Numbers queued']);


        /*foreach ($recipientsChunks as $recipientsChunk) {

            foreach ($recipientsChunk as $recipient) {

                $this->sendEmailToRecipient($recipient, $apiInstance);
            }

            // Sleep for 30 seconds before sending the next batch
            sleep(5);
        }*/

        //return 'Emails sent with delays.';

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
