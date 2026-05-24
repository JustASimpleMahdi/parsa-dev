<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

#[Fillable('text')]
class Resume extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'user_id';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function files(): HasManyThrough
    {
        return $this->hasManyThrough(File::class, ResumeFile::class);
    }
}
