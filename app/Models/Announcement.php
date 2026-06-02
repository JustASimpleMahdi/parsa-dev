<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable('title', 'text')]
class Announcement extends Model
{
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }
}
