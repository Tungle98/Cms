<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VoucherUser extends Model
{
    //
    protected $fillable = ['user_id', 'full_name','total_voucher','voucher_id','code','email','phone','status','method_paid','check_in','check_out','number_adult','number_children','number_babie','booking_service','note'];

    public function vouchers()
    {
        return $this->belongsToMany('App\Model\Voucher');
    }
    public function properties() {
        return $this->belongsToMany('App\Model\Property' ,'user_p', 'voucher_user_id', 'property_id')
            ->withPivot(['value']);
    }
}
