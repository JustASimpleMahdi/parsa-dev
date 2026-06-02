<?php

namespace App\Models;

use App\JobRequestStatusEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class JobRequest extends Pivot
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function job_opportunity(): BelongsTo
    {
        return $this->belongsTo(JobOpportunity::class);
    }

    protected function casts(): array
    {
        return [
            'status' => JobRequestStatusEnum::class
        ];
    }
}
