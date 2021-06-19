<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_voucher');
            $table->date('date_create');
            $table->date('date_ex');
            $table->string('golf_course');
            $table->string('money');
            $table->string('voucher_number');
            $table->text('voucher_content');
            $table->string('image');
            $table->string('status');
            $table->integer('voucher_type_id')->unsigned();
            $table->foreign('voucher_type_id')->references('id')->on('voucher_types')->onDelete('cascade');
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
        Schema::dropIfExists('vouchers');
    }
}
