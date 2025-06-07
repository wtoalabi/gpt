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

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $subject;
    protected $message;
    protected $sender;

    public function __construct($email, $subject, $message, $sender)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
        $this->sender = $sender;
    }

    /**
     * Execute the job.
     */
    public function handle(){


        $sendSmtpEmails = new SendSmtpEmail([
            'sender' => ['name' => $this->sender, 'email' => env('SENDER_EMAIL', 'orders@outletmartuk.store')],
            'to' => [['email' => $this->email]],
            'subject' => $this->subject,
            'htmlContent' => $this->message,
        ]);

        //dd($sendSmtpEmails);

        try {
            $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', env('BREVO_API_KEY'));
            //dd($config);
            $apiInstance = new TransactionalEmailsApi(
                new \GuzzleHttp\Client(),
                $config
            );
            // Send batch of emails
            $results = $apiInstance->sendTransacEmail($sendSmtpEmails);
            Log::info('Email sent successfully', [
                'email' => $this->email,
                'response' => $results
            ]);
            return $results;
        } catch (Exception $e) {
            Log::error('Failed to send email', [
                'email' => $this->email,
                'error' => $e->getMessage()
            ]);
            echo 'Exception when calling TransactionalEmailsApi->sendBatchEmails: ', $e->getMessage(), PHP_EOL;
        }
        //Mail::to($this->email)->send(new YourMailable());
    }
}
