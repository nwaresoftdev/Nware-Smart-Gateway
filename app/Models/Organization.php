<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'name',
        'gst_number',
        'pan_number',
        'aadhar_number',
        'contact_name',
        'contact_number',
        'contact_email',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'pincode',
    ];

}
