<?php


namespace App\Repositories;


use App\Models\Product;
use App\Models\ProductImage;
use App\Services\Image\ImageUploader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductBasicRepository
{



    public function store($request)
    {
        $thumbImagePatch = '';
        $createdProduct = '';

        $realTimestamp = substr($request->published_at, 0, 10);
        $published_at = date("Y-m-d H:i:s", (int)$realTimestamp);

        DB::transaction(function () use ($thumbImagePatch, $published_at, $request) {

            $createdProduct = Product::create([
                'brand_id' => $request->brand_id,
                'status' => $request->is_active,
                'admin_id' => Auth::guard('admin')->id(),
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

            if ($request->hasFile('thumbnail_image'))

                if (!$this->uploadImages($createdProduct, $request)) {
                    session()->flash('warning', __('messages.An_error_occurred_while_updated'));
                    return redirect()->back();
                }

                // get image filename with the extension
                $fileNameWithExt = $request->file('thumbnail_image')->getClientOriginalName();

                // get just filename
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // get just extension
                $extension = $request->file('thumbnail_image')->getClientOriginalExtension();
                // filename for store
                $fileNameToStore = 'thumbnail' . $fileName . '_' . time() . '.' . $extension;
                // path image for store
                $thumbImagePatch = "images/product/thumbnail/" . $fileNameToStore;
                

            return $createdProduct;
        });

    }


    public function update($request)
    {


        $current_product = Product::findOrFail($request->product);

        if ($request->hasFile('thumbnail_image')) {

            if($current_product->thumbnail_image != null ){
                if (Storage::disk('public')->exists($current_product->thumbnail_image)) {
                    Storage::disk('public')->delete($current_product->thumbnail_image);
                }
            } else{
                // get filename with the extension
                $fileNameWithExt = $request->file('thumbnail_image')->getClientOriginalName();
                // get just filename
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // get just extension
                $extension = $request->file('thumbnail_image')->getClientOriginalExtension();
                // filename to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                // path image to store
                $pathToStore = "images/product/thumbnail/" . $fileNameToStore;
                // store normal image to storage system file
                $request->file('thumbnail_image')->storeAs('public/images/product/thumbnail/', $fileNameToStore);

                $current_product->thumbnail_image = $pathToStore;
            }


        }

        $realTimestamp = substr($request->published_at, 0, 10);
        $published_at = date("Y-m-d H:i:s", (int)$realTimestamp);

        DB::transaction(function () use ($current_product, $published_at, $request) {


        $current_product->sku = $request->sku;
        $current_product->brand_id = $request->brand_id;
        $current_product->status = $request->is_active;
        $current_product->admin_id = Auth::guard('admin')->id();
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
        return $current_product;
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


    private function uploadImages($createdProduct, $validateData)
    {
        $sourceImagePath = null;
        $data = [];
        $basPath = 'products/' . $createdProduct->id . '/';

        try {

            if (isset($validateData['source_url'])) {
                $sourceImagePath = $basPath . 'source_url_' . $validateData['source_url']->getClientOriginalName();
                ImageUploader::upload($validateData['source_url'], $sourceImagePath, 'local_storage');
                $data += ['source_url' => $sourceImagePath];
            }
            if (isset($validateData['thumbnail_path'])) {
                $full_path = $basPath . 'thumbnail_path' . '_' . $validateData['thumbnail_path']->getClientOriginalName();
                ImageUploader::upload($validateData['thumbnail_path'], $full_path, 'public');
                $data += ['thumbnail_path' => $full_path];

            }
            if (isset($validateData['demo_url'])) {
                $full_path = $basPath . 'demo_url' . '_' . $validateData['demo_url']->getClientOriginalName();
                ImageUploader::upload($validateData['demo_url'], $full_path, 'public');
                $data += ['demo_url' => $full_path];

            }
            $updated = $createdProduct->update($data);
            if (!$updated) {
                session()->flash('warning', __('messages.An_error_occurred_while_uploading_images'));
                return redirect()->back();
            }
            return true;
            //            session()->flash('success', __('messages.The_update_was_completed_successfully'));
            //            return redirect()->route('admin.product.index');
        } catch (\Exception $ex) {
            return false;
        }

    }


}
