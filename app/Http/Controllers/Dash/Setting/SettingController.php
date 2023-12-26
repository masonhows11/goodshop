<?php

namespace App\Http\Controllers\Dash\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Services\image\ImageServiceSave;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{


    public function edit(Setting $setting)
    {

        return view('dash.setting.edit', ['setting' => $setting]);
    }

    public function update(SettingRequest $request)
    {

        try {
            $setting = Setting::findOrFail($request->setting_id);
            $imgService = new  ImageServiceSave();
            if ($request->hasFile('logo')) {

                if ($setting->logo != null) {
                    if (Storage::disk('public')->exists($setting->logo)) {
                        $imgService->deleteOldStorageImage($setting->logo);
                    }

                }
                $result = $imgService->customSaveStoragePath($request->file('logo'), 'setting','logo', 250, 250);
                $logo_path = $result;
                $setting->logo = $logo_path;
            }

            if ($request->hasFile('icon')) {

                if ($setting->icon != null) {

                    if (Storage::disk('public')->exists($setting->icon)) {
                        $imgService->deleteOldStorageImage($setting->icon);
                    }

                }
                $result = $imgService->customSaveStoragePath($request->file('icon'), 'setting','icon' ,64, 64);
                $icon_path = $result;
                $setting->icon = $icon_path;
            }


            $setting->title = $request->title;
            $setting->description = $request->description;
            $setting->keywords = $request->keywords;
            $setting->save();

            session()->flash('success', __('messages.The_update_was_completed_successfully'));
            return redirect()->route('admin.setting.index');

        } catch (\Exception $ex) {
            return view('errors_custom.general_error')
                ->with(['error' => $ex->getMessage()]);
        }


    }
}
