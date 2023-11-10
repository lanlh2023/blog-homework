<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\File as FacadesFile;
use \Illuminate\Http\UploadedFile;
class File
{
    /**
     * Upload file base64 to public
     *
     * @param string $file
     * @return mixed|null
     */
    public static function uploadFileBase64ToPublic(string $image_64)
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

     /**
     * upload image to public
     *
     * @param UploadedFile $file
     * @return array
     */
    public static function uploadImageToPublic(UploadedFile $file)
    {

        $pathInfo = pathinfo($file->getClientOriginalName());
        $fileName = $pathInfo['filename'];
        $extension = $pathInfo['extension'];
        $fileName = $fileName . '_' . Carbon::now('Asia/Ho_Chi_Minh')->format('YmdHisu') . '.' . $extension;

        $path = $file->move(public_path('images/post_title'), $fileName);

        return [
            'path' => $path,
            'fileName' => $fileName,
        ];
    }
}
