<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('request_id', 'text')]
class RequestResponse extends Model
{
    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }
}
