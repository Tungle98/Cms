<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table='products';
    protected $fillable = ['name', 'detail'];
    public function properties() {
        return $this->belongsToMany('App\Model\Property' ,'user_voucher_pro', 'voucher_id', 'property_id')
            ->withPivot(['value']);
    }
}
