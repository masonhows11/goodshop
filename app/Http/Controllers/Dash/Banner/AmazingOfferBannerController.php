<?php

namespace App\Http\Controllers\Dash\Banner;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest\BannerRequest;
use App\Http\Requests\BannerRequest\EditBannerRequest;
use App\Models\AmazingOfferBanner;
use App\Services\image\ImageServiceSave;


class AmazingOfferBannerController extends Controller
{
    public function create()
    {
        return view('dash.amazing_offer_banner.create');
    }

    public function store(BannerRequest $request)
    {
        try {
            $count = AmazingOfferBanner::count();
            if($count == 4){
                session()->flash('success',__('messages.you_can_upload_only_four_image'));
                return redirect()->route('admin.amazing.banner.index');
            }

            $banner = new AmazingOfferBanner();
            if($request->has('image_path')){
                $imageSave = new ImageServiceSave();
                $image_path =  $imageSave->customSavePublicPath($request->image_path,'amazing_banner');
                $banner->image_path = $image_path;
            }
            $banner->title = $request->title;
            $banner->url = $request->url;
            $banner->status = $request->status;
            $banner->save();
            session()->flash('success',__('messages.New_record_saved_successfully'));
            return redirect()->route('admin.amazing.banner.index');
        }catch (\Exception $ex){
            return view('errors_custom.model_store_error');
        }


    }

    public function edit(AmazingOfferBanner $banner){
        return view('dash.amazing_offer_banner.edit',['banner' => $banner]);
    }


    public function update(EditBannerRequest $request){

        try {
            $banner = AmazingOfferBanner::findOrFail($request->banner);
            if($request->has('image_path')){
                ImageServiceSave::deleteOldPublicImage($banner->image_path);
                $imageSave = new ImageServiceSave();
                $image_path =  $imageSave->customSavePublicPath($request->image_path,'amazing_banner');
                $banner->image_path = $image_path;
            }
            $banner->title = $request->title;
            $banner->url = $request->url;
            $banner->status = $request->status;
            $banner->save();
            session()->flash('success',__('messages.The_update_was_completed_successfully'));
            return redirect()->route('admin.amazing.banner.index');
        }catch (\Exception $ex){
            return view('errors_custom.model_store_error');
        }
    }
}
