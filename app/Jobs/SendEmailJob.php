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
        $textFallback = $this->generateTextFallbackFromHtml($this->message);

        $payload = [
            'sender' => ['name' => $this->sender, 'email' => env('SENDER_EMAIL', 'orders@outletmartuk.store')],
            'to' => [['email' => $this->email]],
            'subject' => $this->subject,
            'htmlContent' => $this->message,
        ];

        if (!empty($textFallback)) {
            $payload['textContent'] = $textFallback;
        }

        $sendSmtpEmails = new SendSmtpEmail($payload);

        //dd($sendSmtpEmails);

        try {
            $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', env('BREVO_API_KEY'));
            //dd($concfig);
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

    /**
     * Generate a readable plain-text fallback for HTML email content.
     *
     * 
     * This method keeps HTML delivery intact while creating a text alternative
     * for email clients that prefer plain text rendering or spam filters that
     * score messages based on multipart content quality.
     *
     * @param string $content Original message body provided to the job.
     * @return string|null Plain-text fallback when HTML is detected, otherwise null.
     */
    private function generateTextFallbackFromHtml(string $content): ?string
    {
        if ($content === strip_tags($content)) {
            return null;
        }

        $withoutNonTextBlocks = preg_replace('/<(script|style)\b[^>]*>.*?<\/\1>/is', ' ', $content);

        $normalizedBreaks = preg_replace('/<br\s*\/?>/i', "\n", $withoutNonTextBlocks);
        $normalizedBreaks = preg_replace('/<\/(p|div|tr|table|section|article|h[1-6]|li)>/i', "\n", $normalizedBreaks);

        $plainText = strip_tags($normalizedBreaks);
        $plainText = html_entity_decode($plainText, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $plainText = preg_replace('/[ \t]+\n/', "\n", $plainText);
        $plainText = preg_replace('/\n{3,}/', "\n\n", $plainText);
        $plainText = trim($plainText);

        return $plainText !== '' ? $plainText : null;
    }
}
