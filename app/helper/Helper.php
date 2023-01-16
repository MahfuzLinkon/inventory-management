<?php
namespace App\helper;

use Intervention\Image\Facades\Image;

class Helper{
    public static function  imageUploader($imageObject, $directory, $existingUrl = null, $width, $height){
        if($imageObject){
            if($existingUrl){
                if(file_exists($existingUrl)){
                    unlink($existingUrl);
                }
            }
            $imageName = time().rand().$imageObject->getClientOriginalName();
            $imageDirectory = 'uploads/images/'.$directory.'/';
            Image::make($imageObject)->resize($width, $height)->save($imageDirectory.$imageName);
            $imageUrl = $imageDirectory.$imageName;
        }else{
            if($existingUrl){
                $imageUrl = $existingUrl;
            }else{
                $imageUrl = null;
            }
        }
        return $imageUrl;
    }






}
