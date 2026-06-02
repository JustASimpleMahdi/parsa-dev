<?php

namespace App\Models;

use App\RequestStatusEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['text'])]
class Request extends Model
{
    public function response(): HasOne
    {
        return $this->hasOne(RequestResponse::class);
    }
    public function type(): BelongsTo
    {
        return $this->belongsTo(RequestType::class, 'request_type_id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    protected function casts(): array
    {
        return [
            'status' => RequestStatusEnum::class,
        ];
    }
}
