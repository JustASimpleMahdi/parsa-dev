<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable(['name', 'title', 'description', 'readonly'])]
class RequestType extends Model
{
    protected static function booted(): void
    {
        static::creating(function (RequestType $requestType) {
            $requestType->name = Str::slug($requestType->title, language: 'fa');
        });
    }
    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }

    protected function casts(): array
    {
        return [
            'readonly' => 'boolean'
        ];
    }
}
