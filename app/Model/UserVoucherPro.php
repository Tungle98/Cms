<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserVoucherPro extends Model
{
    //
    protected $table='user_voucher_pro';
    protected $fillable = ['voucher_id', 'user_id','property_id','value'];

}
