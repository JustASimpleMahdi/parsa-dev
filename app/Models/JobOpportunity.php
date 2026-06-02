<?php

namespace App\Models;

use App\JobRequestStatusEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable('title', 'description', 'capacity', 'hired')]
class JobOpportunity extends Model
{

    protected static function booted(): void
    {
        static::updated(function (JobOpportunity $jobOpportunity) {
            if ($jobOpportunity->is_full) {
                $jobOpportunity->job_requests()
                    ->where('status', JobRequestStatusEnum::PENDING)
                    ->update(['status' => JobRequestStatusEnum::REJECTED]);
            }
        });
    }

    public function job_requests(): HasMany
    {
        return $this->hasMany(JobRequest::class);
    }

    protected function isFull(): Attribute
    {
        return Attribute::get(fn() => $this->capacity === $this->hired);
    }

    protected function remainingCapacity(): Attribute
    {
        return Attribute::get(fn() => $this->capacity - $this->hired);
    }
}
