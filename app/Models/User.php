<?php

namespace App\Models;

use App\RegisterStatusEnum;
use App\RoleEnum;
use Database\Factories\UserFactory;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;


#[Fillable(['username', 'password', 'role', 'register_status'])]
#[Hidden(['password', 'remember_token'])]
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    use Authenticatable, Authorizable;

    public function job_requests(): HasMany
    {
        return $this->hasMany(JobRequest::class);
    }
    public function resume(): HasOne
    {
        return $this->hasOne(Resume::class);
    }

    public function personal_info(): HasOne
    {
        return $this->hasOne(PersonalInfo::class);
    }

    public function isEmployee(): bool
    {
        return $this->hasOne(Employee::class)->exists();
    }

    protected function fullname(): Attribute
    {
        return Attribute::get(fn() => $this->personal_info->firstname . ' ' . $this->personal_info->lastname);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'role' => RoleEnum::class,
            'register_status' => RegisterStatusEnum::class,
        ];
    }
}
