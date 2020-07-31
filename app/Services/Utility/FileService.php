<?php

namespace App\Services\Utility;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function saveFileToLocalPublicDir(Request $request)
    {

        $file = $request->file('recipePicture');
        $fileName = time().$file->getClientOriginalName();

        return Storage::disk('public')->putFileAs('uploads', $file, $fileName);
    }
}
