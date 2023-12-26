<?php

namespace App\Http\Controllers\Dash\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketAdmin;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    //

    public function allTickets()
    {
        $tickets = Ticket::whereNull('ticket_id')->paginate(10);
        $title_page = __('messages.all_tickets');
        return view('dash.tickets.index')
            ->with(['tickets'=> $tickets ,'title_page' => $title_page]);
    }

    public function newTickets(){

        $tickets = Ticket::where('seen',0)->whereNull('ticket_id')->paginate(10);
        foreach ($tickets as $ticket){
            $ticket->seen = 1;
            $ticket->save();
        }
        $title_page = __('messages.new_tickets');
        return view('dash.tickets.index')
            ->with(['tickets'=> $tickets ,'title_page' => $title_page]);
    }

    public function openTickets(){
        $tickets = Ticket::where('status',0)->paginate(10);
        $title_page = __('messages.open_tickets');
        return view('dash.tickets.index')
            ->with(['tickets'=> $tickets ,'title_page' => $title_page]);
    }

    public function closeTickets(){
        $tickets = Ticket::where('status',1)->paginate(10);
        $title_page = __('messages.close_tickets');
        return view('dash.tickets.index')
            ->with(['tickets'=> $tickets ,'title_page' => $title_page]);
    }
    public function showTicket(Ticket $ticket)
    {


        return view('dash.tickets.ticket',['ticket' => $ticket]);
    }

    public function answer(Ticket $ticket,Request $request)
    {
       $request->validate([
          'description' => ['required','min:1','max:2500','string']
       ],$messages=[
           'description' => 'فیلد پاسخ الزامی هست',
       ]);
        try {
            $auth_is_admin_ticket = TicketAdmin::where('admin_id','=', auth()->user()->id )->first();
            if( $auth_is_admin_ticket != null ){
                $ticketAdmin = auth()->user()->ticketAdmin;
                Ticket::create([
                    'subject' => $ticket->subject,
                    'description' => $request->description,
                    'reference_id' => $ticketAdmin->id,
                    'user_id' => $ticket->user_id,
                    'category_id' => $ticket->category_id,
                    'priority_id' => $ticket->priority_id,
                    'ticket_id' => $ticket->id,
                    'seen' => 1,
                    'status' => 0,
                ]);
                session()->flash('success',__('messages.New_record_saved_successfully'));
                return redirect()->back();
            }else{
                session()->flash('warning',__('messages.you_do_not_have_access_to_this_section'));
                return redirect()->back();
            }
        }catch (\Exception $ex){
            return view('errors_custom.model_store_error')
                ->with(['error' => $ex->getMessage()]);
        }


    }

    public function changeStatus(Ticket $ticket)
    {
        $ticket->status = $ticket->status  == 0 ? 1 : 0;
        $ticket->save();
        session()->flash('success',__('messages.The_update_was_completed_successfully'));
        return redirect()->back();
    }

}
