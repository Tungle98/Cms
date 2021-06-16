<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table='product';
    protected $fillable = ['user_voucher_id', 'voucher_id'];
    public function properties() {
        return $this->belongsToMany('App\Model\Property' ,'user_p', 'voucher_user_id', 'property_id')
            ->withPivot(['value']);
    }
}
