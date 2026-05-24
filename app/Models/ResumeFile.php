<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ResumeFile extends Pivot
{
    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }
}
