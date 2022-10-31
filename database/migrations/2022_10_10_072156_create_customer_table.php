<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('custmer_id');
            $table->string('customer_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address');
            $table->timestamps();
            // $table->increments('cus_id', 20);
            // $table->string('cus_name', 255);
            // $table->string('email', 255)->unique();
            // $table->string('phone', 25);
            // $table->string('address', 255);
            // $table->integer('usc_id')->unsigned();
            // $table->foreign('usc_id')->references('usc_id')->on('user_cus');
            // $table->integer('state_order');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
};
