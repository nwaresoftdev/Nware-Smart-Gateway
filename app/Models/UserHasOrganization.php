<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHasOrganization extends Model
{
    protected $fillable = [
        'user_id',
        'organization_id',
    ];
}
