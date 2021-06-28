<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('purchase_representative');
            $table->integer('total_ticket');
            $table->date('flight_date');
            $table->string('flight_hour');
            $table->string('flight_number');
            $table->string('bundled_service');
            $table->string('status');
            $table->string('money');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airports');
    }
}
