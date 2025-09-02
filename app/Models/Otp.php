<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = ['user_id', 'otp', 'type', 'verified_at'];
//    protected $casts = [
//        'created_at' => 'datetime:Y-m-d H:i:s',
//        'updated_at' => 'datetime:Y-m-d H:i:s',
//        'deleted_at' => 'datetime:Y-m-d H:i:s'
//    ];

    public static function updateOptVerifiedAt($otp): void
    {
        Otp::find($otp->id)->update(['verified_at' => Carbon::now()]);

    }
}
