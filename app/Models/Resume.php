<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable('text')]
class Resume extends Model
{
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function files(): HasManyThrough
    {
        return $this->hasManyThrough(File::class, ResumeFile::class);
    }
}
