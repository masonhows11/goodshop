<?php

namespace App\Http\Controllers\Dash\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\MailNotice\MailNoticeRequest;
use App\Models\PublicMailFile;
use App\Services\file\FileService;
use Illuminate\Http\Request;

class AdminEmailNoticeFileController extends Controller
{

    public function emailFileIndex(Request $request)
    {
        return view('dash.notice_email_file.index',['file' => $request->id]);
    }

    public function create(Request $request)
    {
        return view('dash.notice_email_file.create', ['mail_id' => $request->mail_id]);
    }

    public function store(MailNoticeRequest $request, FileService $fileService)
    {
        try {

            $file_path = null;
            $file_size = null;
            $file_type = null;
            $result = null;

            if ($request->hasFile('file')) {

                $fileService->setMainDirectory('files' . DIRECTORY_SEPARATOR . 'email-notice-files');
                $fileService->setFileSize($request->file('file'));
                $file_size = $fileService->getFileSize();
                $result = $fileService->moveToPublic($request->file('file'));
                $file_type = $fileService->getFileFormat();
            }
            if ($result === false) {
                session()->flash('success', __('messages.upload_file_error'));
                return redirect()->back();
            }


            $mail_id = $request->mail;
            PublicMailFile::create([
                'public_mail_id' => $mail_id,
                'file_type' => $file_type,
                'file_size' => $file_size,
                'file_path' => $result,
                'status' => $request->status,
            ]);

            session()->flash('success', __('messages.New_record_saved_successfully'));
            return  redirect()->route('admin.email.notice.file.index',['id' => $mail_id]);

        } catch (\Exception $ex) {
          //  return  $ex->getMessage();
            return view('errors_custom.model_store_error')
                ->with(['error' => $ex->getMessage()]);
        }
    }
}
