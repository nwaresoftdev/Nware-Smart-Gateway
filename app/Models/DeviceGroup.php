<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class DeviceGroup extends Model
{
    use HasFactory, Notifiable, softDeletes;
    protected $fillable = [
        'user_id',
        'group_name',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }


    /*END::CLASS*/
}
