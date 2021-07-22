<?php

namespace App\Services\Utility;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function saveFileToLocalPublicDir($recipeImage)
    {
        $fileName = time().$recipeImage->getClientOriginalName();

        return Storage::disk('public')->putFileAs('uploads', $recipeImage, $fileName);
    }
}
