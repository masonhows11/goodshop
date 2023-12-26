<?php

namespace App\Http\Controllers\Dash\Banner;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest\BannerRequest;
use App\Http\Requests\BannerRequest\EditBannerRequest;
use App\Models\MainSlider;
use App\Services\image\ImageServiceSave;


class MainSliderController extends Controller
{
    public function create()
    {
        return view('dash.main_slider.create');
    }

    public function store(BannerRequest $request)
    {
        try {
            $count = MainSlider::count();
            if($count == 4){
                session()->flash('success',__('messages.you_can_upload_only_four_image'));
                return redirect()->route('admin.main.banner.index');
            }
            $banner = new MainSlider();
            if($request->has('image_path')){
                $imageSave = new ImageServiceSave();
                $image_path =  $imageSave->customSavePublicPath($request->image_path,'main_slider');
                $banner->image_path = $image_path;
            }
            $banner->title = $request->title;
            $banner->url = $request->url;
            $banner->status = $request->status;
            $banner->save();
            session()->flash('success',__('messages.New_record_saved_successfully'));
            return redirect()->route('admin.main.slider.index');
        }catch (\Exception $ex){
            return view('errors_custom.model_store_error');
        }


    }

    public function edit(MainSlider $banner){
        return view('dash.main_slider.edit',['banner' => $banner]);
    }


    public function update(EditBannerRequest $request){

        try {
            $banner = MainSlider::findOrFail($request->banner);
            if($request->has('image_path')){
                ImageServiceSave::deleteOldPublicImage($banner->image_path);
                $imageSave = new ImageServiceSave();
                $image_path =  $imageSave->customSavePublicPath($request->image_path,'main_slider');
                $banner->image_path = $image_path;
            }
            $banner->title = $request->title;
            $banner->url = $request->url;
            $banner->status = $request->status;
            $banner->save();
            session()->flash('success',__('messages.The_update_was_completed_successfully'));
            return redirect()->route('admin.main.slider.index');
        }catch (\Exception $ex){
            return view('errors_custom.model_store_error');
        }
    }
}
