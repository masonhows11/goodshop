<?php

namespace App\Http\Controllers\Dash\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\TicketAdmin;


class AdminAdminTicketController extends Controller
{
    //
    public function index()
    {

        $admins = Admin::all();
        return view('dash.ticket_admin.index', ['admins' => $admins]);

    }

    public function setAdmin(Admin $admin)
    {

        try {

            TicketAdmin::where('admin_id', $admin->id)->first() ?
                TicketAdmin::where('admin_id', $admin->id)->forceDelete() :
                TicketAdmin::create(['admin_id' => $admin->id]);

            session()->flash('success',__('messages.New_record_saved_successfully'));
            return  redirect()->back();

        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error', ['error' => $ex->getMessage()]);
        }

    }
}
