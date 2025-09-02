<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHasDevice extends Model
{
    protected $fillable = [
        'user_id',
        'device_id',
    ];
}
