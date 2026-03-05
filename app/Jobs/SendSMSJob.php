<?php

namespace App\Jobs;

use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Configuration;
use Brevo\Client\Model\SendSmtpEmail;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendSMSJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $number;
    protected $from;
    protected $body;

    public function __construct($number, $from, $body)
    {
        $this->number = $number;
        $this->from = $from;
        $this->body = $body;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client();
        $apiUrl = 'https://api.bulksms.com/v1/messages';
        $authorizationHeader = "Basic " . env('BULKSMS_API_KEY');

        try {
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Authorization' => $authorizationHeader,
                ],
                'json' => [
                    'to' => [$this->number],
                    'from' => $this->from,
                    'body' => $this->body,
                ],
            ]);

            $responseBody = json_decode((string) $response->getBody(), true);

            // You can log the response or handle it as needed
            \Log::info('SMS sent successfully', ['response' => $responseBody]);

        } catch (\Exception $e) {
            // Handle the exception and log the error
            \Log::error('Failed to send SMS', ['error' => $e->getMessage()]);
        }
    }
}
