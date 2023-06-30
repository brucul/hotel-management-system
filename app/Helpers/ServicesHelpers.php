<?php

namespace App\Helpers;

// File Configuration
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ServicesHelpers
{

    public static function resize_image($file, $width, $height, $path)
    {
        $img = Image::make($file->path());
        $img->resize($width, $height, function($constraint) {
            $constraint->aspectRatio();
        })->save($path);

        return $img;
    }

    public static function delete_image($image)
    {
        if (Storage::exists($image)) {
            Storage::delete($image);
        }

        return true;
    }

    public static function make_directory($dir)
    {
        if (!File::isDirectory($dir)) {
            File::makeDirectory($dir, 0775, true, true);
        }

        return true;
    }

    public static function delete_directory($dir)
    {
        if (File::isDirectory($dir)) {
            File::deleteDirectory($dir, 0775, true, true);
        }
    }

}
