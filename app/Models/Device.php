<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'device_type_id',
        'device_model_id',
        'device_group_id',
        'orgnization_id',
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
}
