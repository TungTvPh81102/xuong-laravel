<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StorageImageTrait
{

    public function storageTraitUpload($request, $fileName, $folderName)
    {
        if ($request->hasFile($fileName)) {
            $file = $request->$fileName;
            $fileNameOrigin = $fileName->getClientOriginalName();
            $fileNameHash = Str::random(20) . '-' . $file->getClientOriginalExtension();
            $filePath = $request->file($fileName)->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameHash);

            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath),
            ];

            return $dataUploadTrait;
        }
        return null;
    }
}
