<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NodeSmartSwitchData extends Model
{
    protected $fillable = [
        'node_id',
        'node_line_on_off',
        'node_line_load',
        'data_timestamp',
    ];
}
