<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Device extends Model
{
    protected $fillable = [
        'device_type_id',
        'device_model_id',
        'device_group_id',
        'organization_id',
        'user_id',
        'device_name',
        'device_on_off',
        'location_id',
        'imei',
        'serial_number',
        'ssid',
        'sku',
        'is_active',
        'firmware_version',
        'connectivity_protocol',
        'version',
        'is_favourite',
        'device_id',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',

        ];
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_has_devices');
    }
    public function deviceGatewayDatas(): HasMany
    {
        return $this->hasMany(DeviceGatewayData::class);
    }
    public function deviceGatewayDataLogs(): HasMany
    {
        return $this->hasMany(DeviceGatewayDataLog::class, 'meter_serial_number', 'serial_number');
    }
    public function deviceGroup(): BelongsTo
    {
        return $this->belongsTo(DeviceGroup::class);
    }

    /*END::CLASS*/
}
