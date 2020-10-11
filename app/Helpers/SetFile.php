<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class SetFile
{
    public static function uploadImageWork($request)
    {
        if (isset($request['image'])) {
            $file = Input::file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(config('filesystems.image_work_path'), $name);
            return $name;
        }
    }
}
