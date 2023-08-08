<?php

namespace App\Services;

use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Visibility;


/**
 * Class AuthService
 *
 * A library for Authentication feature.
 */
class FileService
{

    public function __construct()
    {

    }

    public function saveFile($request)
    {
        $pattern = '/[^a-zA-Z0-9]/';
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $extension = $file->getClientOriginalExtension();
            $timeNow = new DateTime();
            $timeNow =  $timeNow->format('Y-m-d H:i:s');
            $result = preg_replace($pattern, '', $timeNow);
            $newFileName = "product_" . $result .'.'. $extension;
            // // Save file in folder storage/product_image with original name
            $path = Storage::disk('local')->putFileAs('product_image', $file, $newFileName);
            // Continue or save url $path in database
            $destinationPath = public_path('storage/product_image');
            $file->move($destinationPath, $newFileName);
            return $newFileName;
        }

        return "No file uploaded.";
    }
}
