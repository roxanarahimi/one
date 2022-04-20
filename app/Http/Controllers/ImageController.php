<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploadImage($base64_str, $name, $folderPath)
    {
        //base64_encode($base64_str);   //base64_decode($base64_str);
        $image_parts = explode(";base64,", $base64_str);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
//        $file = $folderPath . $name . '.' . $image_type;

        file_put_contents($folderPath . $name, $image_base64);
        $file = $folderPath . $name;
        return $file;

    }

    function resizeImage($path, $name)
    {
        $image_name = $path . $name;
            //main
            $image = imagecreatefromjpeg($image_name);
//            $imgResized = imagescale($image, 1000, 563);
//            imagejpeg($imgResized, $image_name);
            //thumb
//            $imgResized = imagescale($image, 400, 225);
            $image_name = str_replace('.jpg', '_thumb.jpg', $image_name);
//            imagejpeg($imgResized, $image_name);
    }

}
