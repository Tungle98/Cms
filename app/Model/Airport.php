<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    //
    protected $fillable=['code','purchase_representative','total_ticket','flight_date','flight_hour','flight_number','bundled_service','status','money','user_id'];
}
