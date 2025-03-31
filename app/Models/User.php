<?php

namespace App\Models;

use App\Service\MikrotikService;
use App\Traits\MustVerifyContact;
use Exception as ExceptionAlias;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Kalnoy\Nestedset\NodeTrait;

class User extends BaseModel implements AuthorizableContract, AuthenticatableContract
{
    use HasFactory, Notifiable, Authorizable, Authenticatable, MustVerifyContact,NodeTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'is_vip',
        'is_admin',
        "username",
        "has_verified",
        "traffic_limit",
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        "_lft",
        "_rgt"
    ];

    protected $appends = ["traffic"];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'is_admin' => 'boolean',
            'has_verified' => 'boolean',
            'is_vip' => 'boolean',
            'password' => 'hashed',
        ];
    }

    /**
     * @return HasMany
     */
    public function macAddress(): HasMany
    {
        return $this->hasMany(MacAddress::class);
    }

    /**
     * @return HasMany
     */
    public function ipAddress(): HasMany
    {
        return $this->hasMany(IpAddress::class);
    }

    /**
     * @throws ExceptionAlias
     */
    public function getTrafficAttribute(): float|int
    {
        try {
            $traffic = app()
                ->make(MikrotikService::class)
                ->getUserTraffic($this->phone);
            return $traffic != null ? round($traffic['bytes'] / 1024 / 1024, 2) : 0;
        } catch (ExceptionAlias $e) {
            throw new ExceptionAlias($e->getMessage());
        }
    }

    public function getRememberToken(): string|null
    {
        return $this->remember_token;
    }

    /**
     * @param $value
     * @return void
     */
    public function setRememberToken($value): void
    {
        $this->remember_token = $value;
    }

    /**
     * @return string
     */
    public function getRememberTokenName(): string
    {
        return 'remember_token';
    }
}
