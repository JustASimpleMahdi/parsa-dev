<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Storage;

#[Fillable(['name', 'original_name', 'path', 'extension', 'mime_type', 'size', 'disk'])]
class File extends Model
{
    protected function url(): Attribute
    {
        return Attribute::get(fn() => Storage::disk($this->disk)->url($this->path));
    }
}
