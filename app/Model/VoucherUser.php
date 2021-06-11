<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VoucherUser extends Model
{
    //
    protected $fillable = ['user_id', 'full_name','total_voucher','voucher_id','code','status','method_paid'];

    public function vouchers()
    {
        return $this->belongsToMany('App\Model\Voucher');
    }
}
