<?php

namespace App\Http\Controllers\Dash\Banner;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest\BannerRequest;
use App\Http\Requests\BannerRequest\EditBannerRequest;
use App\Models\TopBanner;
use App\Services\image\ImageServiceSave;

class TopBannerController extends Controller
{


    public function create()
    {
        return view('dash.top_banner.create');
    }

    public function store(BannerRequest $request)
    {
        try {

            $count = TopBanner::count();
            if($count == 1){
                session()->flash('success',__('messages.you_can_upload_only_one_image'));
                return redirect()->route('admin.top.banner.index');
            }

            $banner = new TopBanner();
            if($request->has('image_path')){
                $imageSave = new ImageServiceSave();
                $image_path =  $imageSave->customSavePublicPath($request->image_path,'banner');
                $banner->image_path = $image_path;
            }
            $banner->title = $request->title;
            $banner->url = $request->url;
            $banner->status = $request->status;
            $banner->save();
            session()->flash('success',__('messages.New_record_saved_successfully'));
            return redirect()->route('admin.top.banner.index');
        }catch (\Exception $ex){
            return view('errors_custom.model_store_error');
        }


    }


    public function edit(TopBanner $banner){

        return view('dash.top_banner.edit',['banner' => $banner]);
    }


    public function update(EditBannerRequest $request){

       // dd($request);

        try {

            $banner = TopBanner::findOrFail($request->banner);

            if($request->has('image_path')){
                ImageServiceSave::deleteOldPublicImage($banner->image_path);
                $imageSave = new ImageServiceSave();
                $image_path =  $imageSave->customSavePublicPath($request->image_path,'banner');
                $banner->image_path = $image_path;
            }
            $banner->title = $request->title;
            $banner->url = $request->url;
            $banner->status = $request->status;
            $banner->save();

            session()->flash('success',__('messages.The_update_was_completed_successfully'));
            return redirect()->route('admin.top.banner.index');
        }catch (\Exception $ex){
            return view('errors_custom.model_store_error');
        }
    }
}
