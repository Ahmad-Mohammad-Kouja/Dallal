<?php

namespace App\Http\Controllers\Clients;

use App\Classes\FileHelper;
use App\Classes\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Property\Image\UploadImageRequest;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function uploadImage(uploadImageRequest $request)
    {
        $user=$request->user();
        $path=FileHelper::uploadFile($request->file('image'),$request->get('image_type'),$user->id);
        if(empty($path))
            return ResponseHelper::generalError('uploading fail');
        return ResponseHelper::insert($path);
    }
}
