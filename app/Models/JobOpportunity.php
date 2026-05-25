<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

#[Fillable('title', 'description', 'capacity', 'hired')]
class JobOpportunity extends Model
{
    protected function remainingCapacity(): Attribute
    {
        return Attribute::get(fn() => $this->capacity - $this->hired);
    }
}
