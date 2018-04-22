<?php

namespace App\Http\Controllers\Ajax;

use Storage;
use Illuminate\Http\Request;
use App\Traits\UploadFileTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadImageRequest;

class UploadImageController extends Controller
{
    use UploadFileTrait;
    
    public function uploadImage(UploadImageRequest $request)
    {
        if ($request->ajax()) {
            $thumbnail = $request->image;
            $thumbnailPath = $this->uploadFile(config('settings.document.path_thumbnail'), $thumbnail);
            $urlImage = Storage::url($thumbnailPath);
            
            return response()->json($urlImage);
        }

        return response()->json(false);
    }

    public function removeImage(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([
                'success' => false,
            ]);
        }

        $urlImage = $request->imageURL;

        if (Storage::disk('local')->exists($urlImage)) {
            Storage::disk('local')->delete($urlImage);
        }

        return response()->json([
            'success' => true,
        ]);
    }
}
