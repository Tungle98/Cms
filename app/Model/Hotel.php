<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    //
    protected $fillable = [
        "name_hotel",
        "type_room",
        'description',
        'voucher_user_id',
        'check_in',
        'check_out',
        'number_customer',
        'number_room',
        'money'
    ];

    public function voucherUser()
    {
        return $this->belongsTo('App\Model\VoucherUser');
    }
}
