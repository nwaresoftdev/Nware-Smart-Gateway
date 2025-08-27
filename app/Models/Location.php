<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'pincode',
    ];
}
