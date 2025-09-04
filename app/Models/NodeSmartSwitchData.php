<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NodeSmartSwitchData extends Model
{
    protected $fillable = [
        'node_id',
        'node_line_on_off',
        'node_line_load',
        'data_timestamp',
    ];

    public function node(): BelongsTo
    {
        return $this->belongsTo(Node::class);
    }
    /*END::CLASS*/
}
