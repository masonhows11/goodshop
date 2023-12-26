<?php


namespace App\Repositories;


use App\Models\Product;
use App\Models\ProductImage;
use App\Services\image\ImageUploader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductBasicRepository
{


    public function store($request)
    {

        $thumbImagePatch = '';
        $createdProduct = null;
        $author = Auth::guard('admin')->id();


        $realTimestamp = substr($request->published_at, 0, 10);
        $published_at = date("Y-m-d H:i:s", (int)$realTimestamp);

        // for save product public info
        DB::transaction(function () use ($author, $thumbImagePatch, $published_at, $request) {

            $createdProduct = Product::create([
                'brand_id' => $request->brand_id,
                'status' => $request->status,
                'admin_id' => $author,
                'title_english' => $request->title_english,
                'title_persian' => $request->title_persian,
                'sku' => $request->sku,
                'tags' => $request->product_tags,
                'thumbnail_image' => $thumbImagePatch,
                'short_description' => $request->short_description,
                'full_description' => $request->full_description,
                'seo_desc' => $request->seo_desc,
                'origin_price' => $request->origin_price,
                'published_at' => $published_at,
                'weight' => $request->weight,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
                'available_in_stock' => $request->available_in_stock,
                'marketable' => $request->marketable,
            ]);

            $createdProduct->categories()->sync($request->categories);

            // for save product thumbnail image
            if ($request->hasFile('thumbnail_image')) {
                if (!$this->uploadImages($createdProduct, $request)) {
                    session()->flash('warning', __('messages.An_error_occurred_while_updated'));
                    return redirect()->back();
                }
            }
            return $createdProduct;
        });

    }

    public function update($request)
    {


        $author = Auth::guard('admin')->id();
        $current_product = Product::findOrFail($request->product);
        $realTimestamp = substr($request->published_at, 0, 10);
        $published_at = date("Y-m-d H:i:s", (int)$realTimestamp);

        DB::transaction(function () use ($author, $current_product, $published_at, $request) {
            $current_product->sku = $request->sku;
            $current_product->brand_id = $request->brand_id;
            $current_product->status = $request->status;
            $current_product->admin_id = $author;
            $current_product->title_english = $request->title_english;
            $current_product->title_persian = $request->title_persian;
            $current_product->short_description = $request->short_description;
            $current_product->full_description = $request->full_description;
            $current_product->tags = $request->product_tags;
            $current_product->seo_desc = $request->seo_desc;
            $current_product->origin_price = $request->origin_price;
            $current_product->published_at = $published_at;
            $current_product->weight = $request->weight;
            $current_product->length = $request->length;
            $current_product->width = $request->width;
            $current_product->height = $request->height;
            $current_product->available_in_stock = $request->available_in_stock;
            $current_product->marketable = $request->marketable;
            $current_product->save();

            $current_product->categories()->sync($request->categories);
        });

        if ($request->hasFile('thumbnail_image')) {

            if ($current_product->thumbnail_image != null && Storage::disk('public')->exists($current_product->thumbnail_image)) {
                Storage::disk('public')->delete($current_product->thumbnail_image);
                $result = $this->uploadImages($current_product, $request);
                if ($result = false) {
                    session()->flash('warning', __('messages.An_error_occurred_while_updated'));
                    return redirect()->back();
                }
            } else {
                $result = $this->uploadImages($current_product, $request);
                if ($result = false) {
                    session()->flash('warning', __('messages.An_error_occurred_while_updated'));
                    return redirect()->back();
                }
            }
        }
        return $current_product;
    }

    private function uploadImages($createdProduct, $request)
    {
        $sourceImagePath = null;
        $data = [];
        $basPath = 'products/' . $createdProduct->id . '/';
        try {
            if (isset($request->thumbnail_image)) {
                $full_path = $basPath . 'thumbnail_image' . '_' . $request->thumbnail_image->getClientOriginalName();
                ImageUploader::upload($request->thumbnail_image, $full_path, 'public');
                $data = ['thumbnail_image' => $full_path];
            }
            $updated = $createdProduct->update($data);
            if (!$updated) {
                session()->flash('warning', __('messages.An_error_occurred_while_uploading_images'));
                return redirect()->back();
            }
            return true;
        } catch (\Exception $ex) {
            return false;
        }

    }


    public function delete($request)
    {
        $product = Product::findOrfail($request->id);;
        $images = ProductImage::where('product_id', $request->id)->get();
        if (Storage::disk('public')->exists($product->thumbnail_image)) {
            Storage::disk('public')->delete($product->thumbnail_image);
        }
        if (count($images) > 0) {
            foreach ($images as $image) {
                if (Storage::disk('public')->exists('/images/product/thumbnail/' . $image->thumbnail_path)) {
                    Storage::disk('public')->delete(['/images/product/thumbnail/' . $image->image_path]);
                }
                $images->each->delete();
            }
        }
        if ($product->delete()) {
            return 'true';
        } else {
            return 'false';
        }

        //        if (count($images) > 0) {
        //            foreach ($images as $image) {
        //                if (Storage::disk('public')->exists($image->thumbnail_path) && Storage::disk('public')->exists($image->image_path)) {
        //                    Storage::disk('public')->delete([$image->thumbnail_path, $image->image_path]);
        //                }
        //                $images->each->delete();
        //            }
        //        }
    }


}
