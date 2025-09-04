<?php

namespace App\Models;

use App\Http\Resources\DeviceGatewayDataResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
/*END::CLASS*/
}
