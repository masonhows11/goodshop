<?php

namespace App\Http\Controllers\Dash\Banner;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest\BannerRequest;
use App\Http\Requests\BannerRequest\EditBannerRequest;
use App\Models\bottomTwoBanner;
use App\Services\image\ImageServiceSave;


class BottomBannerController extends Controller
{
    public function create()
    {
        return view('dash.bottom_banner.create');
    }

    public function store(BannerRequest $request)
    {
        try {

            $count = bottomTwoBanner::count();

            if($count == 2){
                session()->flash('success',__('messages.you_can_upload_only_two_image'));
                return redirect()->route('admin.bottom.banner.index');
            }

            $banner = new bottomTwoBanner();
            if($request->has('image_path')){
                $imageSave = new ImageServiceSave();
                $image_path =  $imageSave->customSavePublicPath($request->image_path,'bottom_banner');
                $banner->image_path = $image_path;
            }
            $banner->title = $request->title;
            $banner->url = $request->url;
            $banner->status = $request->status;
            $banner->save();
            session()->flash('success',__('messages.New_record_saved_successfully'));
            return redirect()->route('admin.bottom.banner.index');
        }catch (\Exception $ex){
            return view('errors_custom.model_store_error');
        }


    }

    public function edit(bottomTwoBanner $banner){
        return view('dash.bottom_banner.edit',['banner' => $banner]);
    }


    public function update(EditBannerRequest $request){

        try {
            $banner = bottomTwoBanner::findOrFail($request->banner);
            if($request->has('image_path')){
                ImageServiceSave::deleteOldPublicImage($banner->image_path);
                $imageSave = new ImageServiceSave();
                $image_path =  $imageSave->customSavePublicPath($request->image_path,'bottom_banner');
                $banner->image_path = $image_path;
            }
            $banner->title = $request->title;
            $banner->url = $request->url;
            $banner->status = $request->status;
            $banner->save();
            session()->flash('success',__('messages.The_update_was_completed_successfully'));
            return redirect()->route('admin.bottom.banner.index');
        }catch (\Exception $ex){
            return view('errors_custom.model_store_error');
        }
    }
}
