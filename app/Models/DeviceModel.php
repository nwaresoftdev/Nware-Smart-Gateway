<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceModel extends Model
{
    protected $fillable = [
        'device_type_id',
        'device_model_name',
        'description',
    ];
}
