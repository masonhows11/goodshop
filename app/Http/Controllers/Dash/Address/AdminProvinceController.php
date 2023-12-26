<?php

namespace App\Http\Controllers\Dash\Address;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class AdminProvinceController extends Controller
{
    //

    public function index()
    {
        $provinces = Province::paginate(5);
        return view('dash.address_province.index', ['provinces' => $provinces]);
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'min:1', 'max:64', 'string']
        ]);

        try {

            Province::create([
                'name' => $request->name,
            ]);

            session()->flash('success', __('messages.New_record_saved_successfully'));
            return redirect()->route('admin.province.index');

        } catch (\Exception $ex) {

            return view('errors_custom.model_store_error')
                ->with(['error' => $ex->getMessage()]);
        }


    }

    public function edit(Province $province)
    {

        try {
            return view('dash.address_province.edit',['province' => $province]);

        } catch (\Exception $ex) {

            return view('errors_custom.model_not_found')
                ->with(['error' => $ex->getMessage()]);
        }

    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:1', 'max:64', 'string']
        ]);

        try {
            Province::where('id',$request->id)->update([
                'name' => $request->name,
            ]);

            session()->flash('success', __('messages.The_update_was_completed_successfully'));
            return redirect()->route('admin.province.index');

        } catch (\Exception $ex) {

            return view('errors_custom.model_store_error')
                ->with(['error' => $ex->getMessage()]);
        }
    }

    public function delete(Province $province,Request $request)
    {
        try {
            $province->delete();
            session()->flash('success', __('messages.The_deletion_was_successful'));
            return redirect()->route('admin.province.index');
        } catch (\Exception $ex) {
            return view('errors_custom.general_error')->with(['error' => $ex->getMessage()]);
        }
    }
}
