<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(
    'firstname',
    'lastname',
    'father_name',
    'birthdate',
    'birthplace',
    'id_number',
    'national_code',
    'phone',
    'address',
    'postal_code',
    'personal_image',
    'last_degree',
    'personal_image_file_id',
    'last_degree_file_id'
)]
class PersonalInfo extends Model
{

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function personal_image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'personal_image_file_id');
    }

    public function last_degree(): BelongsTo
    {
        return $this->belongsTo(File::class, 'last_degree_file_id');
    }

    protected function fullname(): Attribute
    {
        return Attribute::get(fn() => $this->firstname . ' ' . $this->lastname);
    }

}
