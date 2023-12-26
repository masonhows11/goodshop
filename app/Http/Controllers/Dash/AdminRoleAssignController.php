<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminRoleAssignController extends Controller
{
    //
    public function create(Request $request)
    {

        try {
            $user = Admin::findOrFail($request->user_id);
            $roles = Role::all();
            return view('dash.assign_role.role_assign')
                ->with(['user' => $user, 'roles' => $roles]);
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
    }

    public function store(Request $request)
    {
        try {
            $user = Admin::findOrFail($request->id);
            $user->syncRoles($request->roles);
            session()->flash('success',__('messages.The_changes_were_made_successfully'));
            return  redirect()->back();
        }catch (\Exception $ex){
            return view('errors_custom.model_store_error');
        }
    }
}
