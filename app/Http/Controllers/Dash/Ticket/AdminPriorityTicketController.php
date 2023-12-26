<?php

namespace App\Http\Controllers\Dash\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Admin\Ticket\PriorityTicket;
use App\Models\TicketPriority;
use Illuminate\Http\Request;

class AdminPriorityTicketController extends Controller
{
    public function priorityTickets()
    {
        return view('dash.ticket_priority.index');
    }

    public function create(){

        return view('dash.ticket_priority.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','min:2','max:64','string'],
            'status' => ['required']
        ]);

        try {
            TicketPriority::create([
                'name' => $request->name,
                'status' => $request->status,
            ]);
            session()->flash('success',__('messages.New_record_saved_successfully'));
            return redirect()->route('admin.priority.tickets');
        }catch (\Exception $ex){
            session()->flash('success',__('messages.An_error_occurred'));
            return view('errors_custom.model_store_error',['error' => $ex->getMessage()]);
        }

    }

    public function edit(TicketPriority $ticketPriority)
    {
        return view('dash.ticket_priority.edit',['priority' => $ticketPriority]);
    }

    public function update(Request $request){

        $request->validate([
            'name' => ['required','min:2','max:64','string'],
            'status' => ['required']
        ]);


        try {
            TicketPriority::where('id',$request->ticket)->update([
                'name' => $request->name,
                'status' => $request->status,
            ]);
            session()->flash('success',__('messages.New_record_saved_successfully'));
            return redirect()->route('admin.priority.tickets');
        }catch (\Exception $ex){
            session()->flash('success',__('messages.An_error_occurred'));
            return view('errors_custom.model_store_error',['error' => $ex->getMessage()]);
        }
    }
}
