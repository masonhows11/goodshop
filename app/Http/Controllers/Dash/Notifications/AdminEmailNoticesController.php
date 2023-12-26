<?php

namespace App\Http\Controllers\Dash\Notifications;

use App\Http\Controllers\Controller;
use App\Jobs\SendPublicEmailToUsers;
use App\Models\PublicMail;
use App\Models\User;
use App\Services\Message\Email\EmailService;
use App\Services\Message\MessageService;
use Illuminate\Http\Request;

class AdminEmailNoticesController extends Controller
{
    //
    public function index()
    {
        return view('dash.notice_email.index');
    }



    public function create()
    {
        return view('dash.notice_email.create');
    }

    public function store(Request $request){

        $realTimestamp = substr($request->published_at, 0, 10);
        $published_at = date("Y-m-d H:i:s", (int)$realTimestamp);

        $request->validate([
            'subject' => ['required','min:1','max:30','string'],
            'body' => ['required','min:1','max:500','string'],
            'published_at' => ['required','numeric']
        ]);
        try {

            PublicMail::create([
               'subject' => $request->subject,
               'body' => $request->body,
               'status' => $request->status,
               'published_at' => $published_at
            ]);

            session()->flash('success',__('messages.New_record_saved_successfully'));
            return  redirect()->route('admin.email.notices.index');

        }catch (\Exception $ex){
            return view('errors_custom.model_store_error')
                ->with(['error' => $ex->getMessage()]);
        }

    }

    public function edit(PublicMail $publicMail)
    {

        return view('dash.notice_email.edit',['notice' => $publicMail]);
    }

    public function update(Request $request){

        $realTimestamp = substr($request->published_at, 0, 10);
        $published_at = date("Y-m-d H:i:s", (int)$realTimestamp);
        PublicMail::where('id',$request->notice)->update([
            'subject' => $request->subject,
            'body' => $request->body,
            'status' => $request->status,
            'published_at' => $published_at
        ]);
        session()->flash('success',__('messages.The_update_was_completed_successfully'));
        return  redirect()->route('admin.email.notices.index');
    }

    public function sendMail(PublicMail $mail)
    {
                $users = User::whereNotNull('email')->where('activate',1)->select('email')->get();
                foreach ($users as $user){
                    $emailService = new EmailService();
                    $details = [
                        'title' => $mail->subject,
                        'body' => $mail->body,
                    ];
                    $files = $mail->files;
                    $filePaths = [];
                    foreach ($files as $file){
                        array_push($filePaths,$file->file_path);
                    }
                    $emailService->setEmailFiles($filePaths);
                    $emailService->setDetails($details);
                    $emailService->setFrom('goodshop@gmail.com','goodShopSupport');
                    $emailService->setSubject($mail->subject);
                    $emailService->setTo($user->email);
                    $messageService = new MessageService($emailService);
                    $messageService->send();
                }
        // SendPublicEmailToUsers::dispatch($mail);
        session()->flash('success',__('messages.email_send_successfully'));
        return redirect()->back();
    }
}
