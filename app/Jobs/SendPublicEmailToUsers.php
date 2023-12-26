<?php

namespace App\Jobs;

use App\Models\PublicMail;
use App\Models\User;
use App\Services\Message\Email\EmailService;
use App\Services\Message\MessageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPublicEmailToUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $mail;

    /**
     * Create a new job instance.
     * @param PublicMail $mail
     */
    public function __construct(PublicMail $mail)
    {
      $this->mail = $mail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::whereNotNull('email')->where('activate',1)->select('email')->get();
        foreach ($users as $user){
            $emailService = new EmailService();
            $details = [
                'title' => $this->mail->subject,
                'body' => $this->mail->body,
            ];
            $emailService->setDetails($details);
            $emailService->setFrom('goodshop@gmail.com','goodShopSupport');
            $emailService->setSubject($this->mail->subject);
            $emailService->setTo($user->email);
            $messageService = new MessageService($emailService);
            $messageService->send();
        }
    }
}
