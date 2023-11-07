<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploadTempImage(Request $request)
    {

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $fileName = $file->getClientOriginalName();
        $fileName = $fileName . '_' . Carbon::now('Asia/Ho_Chi_Minh')->format('YmdHis') . '.' . $extension;
        $description = $request->description;
        $path = $file->move(public_path('images'), $fileName);
        $data = [];
        dd($request->session()->get('image-list'));

        if (!$request->session()->has('image-list')) {
            $request->session()->put('image-list', [
                [
                    'file' => $fileName,
                    'description' => $description,
                ]
            ]);
            $data = $request->session()->get('image-list');
        } else {
            $request->session()->put('image-list', [
                [
                    'file' => $fileName,
                    'description' => $description,
                ]
            ]);
            $data = $request->session()->push('image-list', $data);
        }
        dd($data);
        return view('admin.post.load-images', ['images' =>  $data]);
    }
}
