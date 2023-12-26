<?php

namespace App\Http\Controllers\Dash\Notifications;

use App\Http\Controllers\Controller;
use App\Jobs\SendPublicSMSToUsers;
use App\Models\PublicSms;
use Illuminate\Http\Request;

class AdminSMSNoticeController extends Controller
{
    //
    public function index()
    {
        return view('dash.notice_sms.index');
    }

    public function create()
    {
        return view('dash.notice_sms.create');
    }

    public function store(Request $request){

        $realTimestamp = substr($request->published_at, 0, 10);
        $published_at = date("Y-m-d H:i:s", (int)$realTimestamp);

        $request->validate([
            'title' => ['required','min:1','max:30','string'],
            'body' => ['required','min:1','max:500','string'],
            'published_at' => ['required','numeric']
        ]);
        try {

            PublicSms::create([
                'title' => $request->title,
                'body' => $request->body,
                'status' => $request->status,
                'published_at' => $published_at
            ]);
            session()->flash('success',__('messages.New_record_saved_successfully'));
            return  redirect()->route('admin.sms.notices.index');

        }catch (\Exception $ex){
            return view('errors_custom.model_store_error')
                ->with(['error' => $ex->getMessage()]);
        }
    }

    public function edit(PublicSms $publicSms)
    {
        return view('dash.notice_sms.edit',['notice' => $publicSms]);
    }

    public function update(Request $request)
    {
        $realTimestamp = substr($request->published_at, 0, 10);
        $published_at = date("Y-m-d H:i:s", (int)$realTimestamp);

      //  dd($published_at);
        PublicSms::where('id',$request->notice)->update([
            'title' => $request->title,
            'body' => $request->body,
            'status' => $request->status,
            'published_at' => $published_at
        ]);

        session()->flash('success',__('messages.The_update_was_completed_successfully'));
        return  redirect()->route('admin.sms.notices.index');
    }

    public function sendSms(PublicSms $publicSms)
    {
         session()->flash('warning',__('messages.this_part_is_being_prepared'));
         return redirect()->back();
        // SendPublicSMSToUsers::dispatch($publicSms);
        // session()->flash('success',__('messages.email_send_successfully'));
        //  return redirect()->back();
    }
}
