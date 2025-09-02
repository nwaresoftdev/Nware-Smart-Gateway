<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NodeCameraData extends Model
{
    protected $fillable = [
        'node_id',
        'node_on_off',
        'data_timestamp',
    ];
}
