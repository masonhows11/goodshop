<?php

namespace App\Http\Controllers\Dash\Address;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;


class AdminCityController extends Controller
{


    public function create(Request $request)
    {
        try {
            $province  = Province::findOrFail($request->id);
            $provinceId = $province->id;
            return view('dash.address_city.create', ['province' => $province ,'provinceId' => $provinceId]);
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found')
                ->with(['error' => $ex->getMessage()]);
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'min:1', 'max:64', 'string']
        ]);
        try {
            City::create([
                'province_id' => $request->province,
                'name' => $request->name,
            ]);
            session()->flash('success', __('messages.New_record_saved_successfully'));
            return redirect()->route('admin.city.create',['id' => $request->province]);

        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error')->with(['error' => $ex->getMessage()]);
        }
    }

    public function edit(City $city)
    {

        try {
            return view('dash.address_city.edit',['city' => $city]);
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found')->with(['error' => $ex->getMessage()]);
        }
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => ['required', 'min:1', 'max:64', 'string']
        ]);

        try {
            City::where('id',$request->id)->update([
                'name' => $request->name,
            ]);
            session()->flash('success', __('messages.The_update_was_completed_successfully'));
            return redirect()->route('admin.city.create',['id' => $request->province]);
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error')
                ->with(['error' => $ex->getMessage()]);
        }
    }

    public function delete(City $city,Request $request)
    {
        try {
            $province = $request->province ;
            $city->delete();
            session()->flash('success', __('messages.The_deletion_was_successful'));
            return redirect()->route('admin.city.create',['id' => $province]);
        } catch (\Exception $ex) {
            return view('errors_custom.general_error')->with(['error' => $ex->getMessage()]);
        }
    }
}
