<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    protected $table = 'properties';
    protected $fillable = ['name','type'];

    public function vouchers() {
        return $this->belongsToMany('App\Model\Voucher', 'property_voucher', 'property_id', 'voucher_id');
    }

    public function voucheruser() {
        return $this->belongsToMany('App\Model\VoucherUser', 'user_voucher_pro', 'voucher_user_id', 'voucher_id','property_id')->withPivot(['value']);
    }
}
