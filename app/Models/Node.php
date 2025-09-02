<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    protected $fillable = [
        'user_id',
        'node_type_id',
        'node_model_id',
        'device_gateway_data_id',
        'location_id',
        'node_name',
        'node_on_off',
        'imei',
        'serial_number',
        'ssid',
        'sku',
        'is_active',
        'firmware_version',
        'connectivity_protocol',
        'version',
        'is_favourite',
    ];
}
