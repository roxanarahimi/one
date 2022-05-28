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
//
//    function makeIconPack(Request $request)
//    {
//        $path = '';
//        $name = 'icon.png';
//        $this->uploadImage($request['image'], $name, $path);
//
//        $image_name = $path . $name;
//        //main
//        $image = imagecreatefrompng($image_name);
//        $imgResized = imagescale($image, 100, 100);
//        imagepng($imgResized, $image_name);
//
//        // icon pack
//        $imgResized64 = imagescale($image, 64, 64);
//        $image_name = str_replace('.png', '64x64.png', $image_name);
//        imagejpeg($imgResized64, $image_name);
//
//        $imgResized32 = imagescale($image, 32, 32);
//        $image_name = str_replace('.png', '32x32.png', $image_name);
//        imagejpeg($imgResized32, $image_name);
//        //TODO
//    }

}
