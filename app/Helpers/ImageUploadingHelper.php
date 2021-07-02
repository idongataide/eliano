<?php

namespace App\Helpers;

use Request;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use File;
use Validator;


class ImageUploadingHelper
{
    private static $tinyMCEImgWidth = 500;
    private static $tinyMCEImgHeight = 500;

    public static function Delete_image($image_path)
    {
        if(file_exists($image_path)){
            File::delete($image_path);
        }
    }
    public static function upload_image($image_path,$image_file,$request)
    {
        $result = null;
    
        // Build the input for validation
        $fileArray = array('image' => $image_file);
        
        // Tell the validator that this file should be an image
        $rules = array(
            'image' => 'mimes:jpeg,jpg,png,gif,mp3,mp4,mov,qt|max:100000000' // max 10000kb
        );
    
        // Now pass the input and rules into the validator
        $validator = Validator::make($fileArray, $rules);
    
        // Check to see if validation fails or passes
        if ($validator->fails())
        {
                return $result;
        } else
        {
            // Store the File Now
            // read image from temporary file
            //Image::make($file)->resize(300, 200)->save('foo.jpg');
            
            $filename = $image_file->getClientOriginalName();
            $image_file->move($image_path,  $filename);
            $result = $filename;
        };
    
    
        return $result;
    }
    
    public static function upload_media($media_path,$media_file,$request)
    {
        $result = null;
    
        // Build the input for validation
        $fileArray = array('image' => $media_file);
        
        // Tell the validator that this file should be an image
        $rules = array(
            'image' => 'mimes:mp3,mp4,ogm,wmv,webm,mpeg,mov,|max:1000000' // max 10000kb
        );
    
        // Now pass the input and rules into the validator
        $validator = Validator::make($fileArray, $rules);
    
        // Check to see if validation fails or passes
        if ($validator->fails())
        {
                return $result;
        } else
        {
            // Store the File Now
            // read image from temporary file
            //Image::make($file)->resize(300, 200)->save('foo.jpg');
            
            $filename = $media_file->getClientOriginalName();
            $media_file->move($media_path,  $filename);
            $result = $filename;
        };
    
    
        return $result;
    }










    public static function UploadImageTinyMce($destinationPath, $field, $newName = '')
    {
        $destinationPath = ImageUploadingHelper::real_public_path() . $destinationPath;
        $extension = $field->getClientOriginalExtension();
        //$fileName = $newName . '-' . time() . '-' . rand(1, 999) . '.' . $extension;
        $fileName = str_slug($newName, '-') . '-' . time() . '-' . rand(1, 999) . '.' . $extension;
        $field->move($destinationPath, $fileName);
        /*         * **** Resizing Images ******** */
        $imageToResize = Image::make($destinationPath . '/' . $fileName);
        $imageToResize->resize(self::$tinyMCEImgWidth, self::$tinyMCEImgHeight, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($destinationPath . '/' . $fileName);
        /*         * **** End Resizing Images ******** */
        return $fileName;
    }




    public static function public_path()
    {
        return url('/') . DIRECTORY_SEPARATOR;
    }
    public static function real_public_path()
    {
        return public_path() . DIRECTORY_SEPARATOR;
    }
}