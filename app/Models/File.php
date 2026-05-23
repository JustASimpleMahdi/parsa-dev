<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'original_name', 'path', 'extension', 'mime_type', 'size', 'disk'])]
class File extends Model
{
    //
}
