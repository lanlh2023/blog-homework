<?php

namespace App\Helpers;

use App\Enums\FilePath;
use Carbon\Carbon;
use finfo;
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
    public static function uploadFileBase64ToPublic(string $image_base64)
    {
        $mimeType = mime_content_type($image_base64);
        if (empty($mimeType)) {
            return false;
        }

        $extension = explode('/', $mimeType)[1];
        $imageName = 'post_' . Carbon::now()->format('YmdHisu') . '.' . $extension;

        $path = public_path(FilePath::IMAGE_POSTS . $imageName);

        if(file_put_contents($path, file_get_contents($image_base64))) {
            return FilePath::IMAGE_POSTS . $imageName;
        }

        return false;
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

        return "<img src=\"$imagePath\">";
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
        if (empty($pathInfo)) {
            return false;
        }

        $fileName = $pathInfo['filename'] . '_' . Carbon::now()->format('YmdHisu') . '.' . $pathInfo['extension'];

        $path = $file->move(public_path(FilePath::IMAGE_POST_TITLE), $fileName);

        return [
            'path' => $path,
            'fileName' => $fileName,
        ];
    }
}
