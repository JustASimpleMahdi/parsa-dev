<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable('title', 'description', 'capacity', 'hired')]
class JobOpportunity extends Model
{

    protected function isFull(): Attribute
    {
        return Attribute::get(fn() => $this->capacity === $this->hired);
    }
    public function job_requests(): HasMany
    {
        return $this->hasMany(JobRequest::class);
    }
    protected function remainingCapacity(): Attribute
    {
        return Attribute::get(fn() => $this->capacity - $this->hired);
    }
}
