<?php

namespace App\Helpers;

use App\Enums\FilePath;
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
    public static function uploadFileBase64ToPublic(string $image_base64)
    {
        $mimeType = mime_content_type($image_base64);
        if (empty($mimeType)) {
            return false;
        }

        $extension = explode('/', $mimeType)[1];
        $imageName = 'post_' . Carbon::now()->format('YmdHisu') . '.' . $extension;

        $path = FilePath::IMAGE_POSTS . $imageName;

        if (FacadesFile::put(public_path($path), file_get_contents($image_base64))) {
            return  $path;
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
     * @return string|false
     */
    public static function uploadImageToPublic(UploadedFile $file, string $folderPublic = '')
    {

        $pathInfo = pathinfo($file->getClientOriginalName());
        if (empty($pathInfo)) {
            return false;
        }

        $fileName = $pathInfo['filename'] . '_' . Carbon::now()->format('YmdHisu') . '.' . $pathInfo['extension'];

        $pathFolderPublic = $folderPublic ?? FilePath::IMAGE_POST_TITLE;

        $path = $pathFolderPublic . $fileName;

        if (FacadesFile::put(public_path($path), file_get_contents($file))) {
            return $path;
        }

        return false;
    }

     /**
     * Export csv file with array data and fields
     *
     * @param array $data not null,
     * @param array $headers not null,
     * @return string
     */

     public static function exportCSVFile(array $data, array $headers) :string {
        $file = fopen('php://output', 'w');

        $headerCopy = array_map(function ($value) {
            if (strpos($value, ' ') === false) {
                $value = '"' . $value . '"';
            }
            return $value;
        }, $headers);

        ob_start();

        fputcsv($file, $headerCopy);

        foreach($data as $item) {

            $lineData = [];

            for($i = 0; $i < count($headers); $i++) {
                $value = $item[$headers[$i]] ?? "";

                if (strpos($value, ' ') === false) {
                    $value = '"' . $value . '"';
                }

                $lineData[] = $value;
            }

            fputcsv($file, $lineData, ',', '"');
        }

        fclose($file);

        $csv = ob_get_clean();

        $csv = str_replace('""', '"', str_replace('""', '"', $csv));

        return $csv;
    }
}
