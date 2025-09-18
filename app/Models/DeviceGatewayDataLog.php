<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceGatewayDataLog extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'model','type','imei','header','cum_eb_kwh','cum_dg_kwh','relay_status','eb_dg_status','eb_load_setting','dg_load_setting','meter_serial_number',
        'rtc_date_ddmmyy','rtc_time_hhmmss','eb_terriff_setting','dg_terrif_setting','balance_amount','daily_charge_setting','no_of_over_load_check',
        'over_load_delay_between_two_attemps','over_load_check_time_in_second','last_balance_update','2nd_last_balance_update','3rd_balance_update',
        '4th_balance_update','5th_balance_update','6th_balance_update','7th_balance_update','8th_balance_update','9th_balance_update','10th_balance_update',
        '11th_balance_update','12_th_balance_update','frequency','voltage_r','voltage_y','voltage_b','current_r','current_y','current_b','pf','kw_load_r',
        'kw_load_y','kw_load_b','kva_load_r','kva_load_y','kva_load_b','kvar_load_r','kvar_load_y','kvar_load_b','last_balance_deduction',
        '2nd_last_balance_deduction','3rd_balance_dedeuction','4th_balance_dedeuction','5th_balance_dedeuction','6th_balance_dedeuction','7th_balance_dedeuction',
        '8th_balance_dedeuction','9th_balance_dedeuction','10th_balance_dedeuction','cum_kvah','cum_kvah_dg','cum_kvarh','cum_kvarh_dg','cum_eb_kwh_40060',
        'cum_dg_kwh_40061','total_kw','total_kva','total_kvar','na_40065','na_40066','na_40067','na_40068','na_40069','na_40070','induvisal_relay_status_dg',
        'induvisal_relay_status_eb','over_aattp_eb','over_aattp_dg','na_40075','version','crc'
    ];

}
