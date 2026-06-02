<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'title', 'description', 'readonly'])]
class RequestType extends Model
{
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
