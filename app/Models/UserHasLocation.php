<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHasLocation extends Model
{
    protected $fillable = [
        'user_id',
        'location_id',
    ];
}
