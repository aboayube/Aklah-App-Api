<?php

namespace App\Helpers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ImageClass
{
    public static function create($file, $foldername = '')
    {
        $filename = time() . '-' . time() . '.' . $file->getClientOriginalName();
        $path = public_path('assets/' . $foldername . '/' . $filename);

        Image::make($file->getRealPath())->resize(538, 200)->save($path, 100);
        return  $filename;
    }
    public static function update($file, $oldname, $foldername)
    {
        if ($oldname) {
            if (File::exists('assets/' . $foldername . '/' . $oldname)) {
                unlink('assets/' . $foldername . '/' . $oldname);
            }
        }

        $filename = time() . '-' . time() . '.' . $file->getClientOriginalExtension();
        $path = public_path('assets/' . $foldername . '/' . $filename);
        Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path, 100);

        return $filename;
    }

    public static function delete($image, $folder)
    {
        if ($image) {

            if (File::exists('assets/' . $folder . '/' . $image)) {

                unlink('assets/' . $folder . '/' . $image);
            }
        }
    }
}
