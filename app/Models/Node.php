<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function nodeSmartSwitchDatas(): HasMany
    {
        return $this->hasMany(NodeSmartSwitchData::class);
    }
    /*END::CLASS*/
}
