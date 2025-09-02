<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHasPlan extends Model
{
    protected $fillable = [
        'user_id',
        'payment_plan_id',
    ];

}
