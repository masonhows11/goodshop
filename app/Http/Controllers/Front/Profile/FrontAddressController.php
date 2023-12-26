<?php

namespace App\Http\Controllers\Front\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontAddressController extends Controller
{
    public function addresses()
    {

        $provinces = Province::all();
        $user = Auth::id();
        $addresses = Address::where('user_id',$user)->get();
        return view('front.profile.address',['addresses' => $addresses , 'provinces' => $provinces]);
    }

    public function store(AddressRequest $request)
    {
        try {

            $postal_code = convertPerToEnglish($request->postal_code);

            Address::create([
                'user_id' => Auth::id(),
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'mobile' => $request->mobile,
                'plate_number' => $request->plate_number,
                'postal_code' => $postal_code,
                'recipient_first_name' => $request->recipient_first_name,
                'recipient_last_name' => $request->recipient_last_name,
                'address_description' => $request->address_description,
                'is_active' => 1,
            ]);

            session()->flash('success', __('messages.New_record_saved_successfully'));
            return redirect()->back();

        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error')->with(['error' => $ex->getMessage()]);
        }

    }

    public function update(AddressRequest $request)
    {
        try {

            $postal_code = convertPerToEnglish($request->postal_code);

            Address::where('id', $request->address)->update([
                'user_id' => Auth::id(),
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'mobile' => $request->mobile,
                'plate_number' => $request->plate_number,
                'postal_code' => $postal_code,
                'recipient_first_name' => $request->recipient_first_name,
                'recipient_last_name' => $request->recipient_last_name,
                'address_description' => $request->address_description,
                'is_active' => 1,
            ]);

            session()->flash('success', __('messages.The_update_was_completed_successfully'));
            return redirect()->back();

        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error')
                ->with(['error' => $ex->getMessage()]);
        }

    }

    public function delete(Address $address){
        try {
            $address->delete();
            session()->flash('success',__('messages.The_deletion_was_successful'));
            return redirect()->back();
        }catch (\Exception $ex){
            return view('errors_custom.general_error')
                ->with(['error' => $ex->getMessage()]);
        }
    }
}
