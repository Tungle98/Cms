<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserVoucherPro extends Pivot
{
    //
    protected $table='user_voucher_pro';
    protected $fillable = ['voucher_id','property_id','value'];

}
