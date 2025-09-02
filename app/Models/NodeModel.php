<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NodeModel extends Model
{
    protected $fillable = [
        'node_type_id',
        'name',
        'description',
    ];
}
