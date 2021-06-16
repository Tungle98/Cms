<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserVoucherPro extends Pivot
{
    //
    protected $table='user_p';
    protected $fillable = ['voucher_user_id','property_id','value'];

}
