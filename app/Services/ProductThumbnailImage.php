<?php


namespace App\Services;


class ProductThumbnailImage
{

    public static function save_product_thumbnail_image($thumbnail_image){


        // get image from request
        $image_file = $thumbnail_image;
        // get image filename with the extension
        $fileNameWithExt = $thumbnail_image->getClientOriginalName();
        // get just filename
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        // get just extension
        $extension = $thumbnail_image->getClientOriginalExtension();
        // filename for store
        $fileNameToStore = 'thumbnail' . $fileName . '_' . time() . '.' . $extension;
        // path image for store
        $thumbImagePatch = "images/products/" . $fileNameToStore;
        // store normal image to storage system file
        $thumbnail_image->storeAs('public/images/products/', $fileNameToStore);


        return $thumbImagePatch;

    }
}
