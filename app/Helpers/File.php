<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\File as FacadesFile;

class File
{
    /**
     * Upload file base64 to public
     *
     * @param string $file
     * @return mixed|null
     */
    public static function uploadFileBase64ToPublic($image_64)
    {
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];

        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);

        $image = str_replace($replace, '', $image_64);

        $image = str_replace(' ', '+', $image);

        $imageName = 'post_' . Carbon::now('Asia/Ho_Chi_Minh')->format('YmdHisu') . '.' . $extension;

        $path = public_path() . '/images/' . $imageName;

        $result = FacadesFile::put($path, base64_decode($image));

        $assetLink = "{{ asset('/images/$imageName') }}";

        return $result ? $assetLink : false;
    }

    /**
     * Create tag image
     *
     * @param string $fileName
     * @return tag Image
     */
    public static function createNewTagImage($imagePath = null)
    {
        if (empty($imagePath)) {
            return false;
        }

        $tagImange = "<img src=\"";
        $tagImange .= $imagePath;
        $tagImange .= "\">";
        return $tagImange;
    }
}
