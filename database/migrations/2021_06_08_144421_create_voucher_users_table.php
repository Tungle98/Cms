<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('full_name');
            $table->integer('total_voucher');
            $table->integer('voucher_id')->unsigned();
            $table->foreign('voucher_id')->references('id')->on('vouchers')->onDelete('cascade');
            $table->string('code');
            $table->date('email');
            $table->string('phone');
            $table->string('status');
            $table->string('method_paid');
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->string('number_adult')->nullable();
            $table->string('number_children')->nullable();
            $table->string('number_babie')->nullable();
            $table->string('booking_service')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('voucher_users');
    }
}
