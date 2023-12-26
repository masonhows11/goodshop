<?php

namespace App\Console\Commands;

use App\Jobs\SendPublicEmailToUsers;
use App\Models\PublicMail;
use Illuminate\Console\Command;

class AutoPublicEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:sendPublicEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // its send email  manually run this command
        // dd('hi command test');
        $emailsToSend = PublicMail::where('published_at','=',now())->get();
        // dd($emailsToSend);
        foreach ($emailsToSend as $item){
            SendPublicEmailToUsers::dispatch($item);
        }

    }
}
