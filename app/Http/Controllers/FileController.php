<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\RoleEnum;
use Storage;

class FileController extends Controller
{
    public function getResumeFile(File $file)
    {
        $user = auth()->user();
        if (!($user->role === RoleEnum::MANAGER || $user->resume->files()->where('id', $file->id)->exists())) abort(403);
        return Storage::disk($file->disk)->download($file->path, $file->filename);
    }

    public function getPersonalInfoLastDegree(File $file)
    {
        $user = auth()->user();
        if (!($user->role === RoleEnum::MANAGER || $user->personal_info->personal_image->id === $file->id)) abort(403);
        return Storage::disk($file->disk)->download($file->path, $file->filename);
    }
}
