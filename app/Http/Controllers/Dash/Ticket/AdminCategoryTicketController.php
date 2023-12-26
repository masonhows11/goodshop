<?php

namespace App\Http\Controllers\Dash\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Admin\Ticket\CategoryTicket;
use App\Models\Ticket;
use App\Models\TicketCategory;
use Illuminate\Http\Request;

class AdminCategoryTicketController extends Controller
{
    public function categoryTickets()
    {
        return view('dash.ticket_category.index');
    }

    public function create(){

        return view('dash.ticket_category.create');
    }

    public function store(Request $request)
    {
            $request->validate([
               'name' => ['required','min:2','max:64','string'],
                'status' => ['required']
            ]);


        try {
            TicketCategory::create([
               'name' => $request->name,
               'status' => $request->status,
            ]);
            session()->flash('success',__('messages.New_record_saved_successfully'));
            return redirect()->route('admin.category.tickets');
        }catch (\Exception $ex){
            return $ex->getMessage();
            session()->flash('success',__('messages.An_error_occurred'));
            return view('errors_custom.model_store_error',['error' => $ex->getMessage()]);
        }
    }

    public function edit(TicketCategory $ticketCategory){

       return view('dash.ticket_category.edit',['category' => $ticketCategory]);
    }

    public function update(Request $request){

        $request->validate([
            'name' => ['required','min:2','max:64','string'],
            'status' => ['required']
        ]);

        try {
            TicketCategory::where('id',$request->ticket)->update([
                'name' => $request->name,
                'status' => $request->status,
            ]);
            session()->flash('success',__('messages.The_update_was_completed_successfully'));
            return redirect()->route('admin.category.tickets');
        }catch (\Exception $ex){
            session()->flash('success',__('messages.An_error_occurred'));
            return view('errors_custom.model_store_error',['error' => $ex->getMessage()]);
        }
    }
}
