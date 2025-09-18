<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'user_type_id',
        'email_verified_at',
        'otp_verified_at',
        'last_login_at',
        'password',
        'fcm_token',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'otp_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function updateInformation($user): void
    {
        User::find($user->id)->update(['last_login_at' => Carbon::now(), 'otp_verified_at' => Carbon::now(), 'ip_address' => request()->ip()]);
    }

    public function otps(): HasMany
    {
        return $this->hasMany(Otp::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(DeviceGroup::class);
    }
    public function devices(): BelongsToMany
    {
        return $this->belongsToMany(Device::class, 'user_has_devices');
    }

    public function nodes(): HasMany
    {
        return $this->hasMany(Node::class);
    }

    public function organizations(): belongsToMany
    {
        return $this->belongsToMany(Organization::class, 'user_has_organizations');
    }


    /*END::CLASS*/
}
