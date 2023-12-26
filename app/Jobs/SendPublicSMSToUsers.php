<?php

namespace App\Jobs;

use App\Models\PublicSms;
use App\Models\User;
use App\Services\Message\MessageService;
use App\Services\Message\SMS\SmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class SendPublicSMSToUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $sms;

    /**
     * Create a new job instance.
     */
    public function __construct(PublicSms $sms)
    {
        //
        $this->sms = $sms;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $users = User::whereNotNull('mobile')->where('activate',1)->select('mobile')->get();
        foreach ($users as $user){
            $smsService = new SmsService();
            $smsService->setFrom(Config::get('sms.config'));
            $smsService->setTo(['0'. $user->mobile]);
            $smsService->setText($this->sms->body);
            $smsService->setIsFlash(true);
            $messageService = new MessageService($smsService);
            $messageService->send();
        }
    }
}
