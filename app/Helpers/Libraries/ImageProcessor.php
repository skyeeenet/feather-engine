<?php

namespace App\Helpers\Libraries;

use Intervention\Image\Facades\Image;

class ImageProcessor {

    public function compress($path, $width, $height) {

        //Resize image here
        $thumbnailPath = public_path($path);

        $img = Image::make($thumbnailPath)->resize($width, $height, function($constraint) {
            $constraint->aspectRatio();
        });

        $img->save($thumbnailPath);
    }
}