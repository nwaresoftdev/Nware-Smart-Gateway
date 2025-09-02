<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceGatewayData extends Model
{
    protected $fillable = [
        'device_id',
        'start_unit_date',
        'device_start_unit',
        'tariff_per_unit',
        'is_new_setup',
        'consumed_unit',
        'remaining_unit',
    ];
}
