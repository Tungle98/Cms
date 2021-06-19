<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    //
    protected $fillable = ['name_voucher', 'date_create','date_ex','golf_course','image','status','voucher_type_id','money','voucher_content','voucher_number','voucher_field'];

    public function voucherType()
    {
        return $this->hasOne('VoucherType::class');
    }
    public function properties() {
        return $this->belongsToMany('App\Model\Property', 'property_voucher', 'voucher_id', 'property_id');
    }
    public function vuser()
    {
        return $this->belongsToMany(VoucherUser::class);
    }
}
