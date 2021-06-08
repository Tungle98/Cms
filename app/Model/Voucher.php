<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    //
    protected $fillable = ['name_voucher', 'date_create','date_ex','golf_course','image','status','voucher_type_id'];

    public function voucherType()
    {
        return $this->hasOne('VoucherType::class');
    }
}
