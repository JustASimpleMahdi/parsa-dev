<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    public function personal_info()
    {
        return $this->hasOneThrough(PersonalInfo::class, User::class, 'id', 'user_id', 'user_id', 'id');
    }
    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
