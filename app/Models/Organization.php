<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function users():belongsToMany
    {
        return $this->belongsToMany(User::class, 'user_has_organizations');
    }
}
