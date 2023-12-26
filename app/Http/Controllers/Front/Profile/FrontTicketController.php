<?php

namespace App\Http\Controllers\Front\Profile;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TicketFile;
use App\Models\TicketPriority;
use App\Services\file\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontTicketController extends Controller
{
    //
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->whereNull('ticket_id')->paginate(10);
        return view('front.profile.tickets.tickets', ['tickets' => $tickets]);
    }

    public function newTicket()
    {
        $categories = TicketCategory::all();
        $priorities = TicketPriority::all();
        return view('front.profile.tickets.new_ticket')
            ->with(['categories' => $categories, 'priorities' => $priorities]);
    }

    public function ticketStore(Request $request, FileService $fileService)
    {

        $request->validate([
            'subject' => ['required', 'min:1', 'max:64', 'string'],
            'description' => ['required', 'min:1', 'max:2500', 'string'],
            'category' => ['required', 'exists:ticket_categories,id'],
            'priority' => ['required', 'exists:ticket_priorities,id'],
            'file' => ['nullable','mimes:png,jpg,jpeg,pdf','max:1999']
        ]);

        try {

            DB::transaction(function () use ($fileService,$request) {

                //// for save ticket info
                $ticket = Ticket::create([
                    'subject' => $request->subject,
                    'description' => $request->description,
                    'reference_id' => null,
                    'user_id' => Auth::id(),
                    'category_id' => $request->category,
                    'priority_id' => $request->priority,
                    'seen' => 0,
                    'status' => 0,
                ]);

                //// for save file ticket
                if ($request->has('file')) {

                    $fileService->setMainDirectory('files' . DIRECTORY_SEPARATOR . 'ticket_files');
                    $fileService->setFileSize($request->file('file'));
                    $filesSize = $fileService->getFileSize();
                    $result = $fileService->moveToStorage($request->file('file'));
                    $fileFormat = $fileService->getFileFormat();

                    TicketFile::create([
                        'file_path' => $result ,
                        'file_size' => $filesSize,
                        'file_type' => $fileFormat,
                        'status' => 0,
                        'user_id' => Auth::id(),
                        'ticket_id' => $ticket->id,
                    ]);
                }

            });

            session()->flash('success', __('messages.new_ticket_added'));
            return redirect()->route('tickets');

        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error')
                ->with(['error' => $ex->getMessage()]);
        }
    }

    public function downloadTicketFile()
    {

    }


    public function showTicket(Ticket $ticket)
    {
        return view('front.profile.tickets.ticket', ['ticket' => $ticket]);
    }

    public function answerTicket(Ticket $ticket, Request $request)
    {
        $request->validate([
            'description' => ['required', 'min:1', 'max:2500', 'string']
        ], $messages = [
            'description' => 'فیلد پاسخ الزامی هست',
        ]);

        try {
            Ticket::create([
                'subject' => $ticket->subject,
                'description' => $request->description,
                'reference_id' => $ticket->reference_id,
                'user_id' => $ticket->user_id,
                'category_id' => $ticket->category_id,
                'priority_id' => $ticket->priority_id,
                'ticket_id' => $ticket->id,
                'seen' => 1,
                'status' => 0,
            ]);
            session()->flash('success', __('messages.New_record_saved_successfully'));
            return redirect()->back();

        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error')
                ->with(['error' => $ex->getMessage()]);
        }
    }
}
