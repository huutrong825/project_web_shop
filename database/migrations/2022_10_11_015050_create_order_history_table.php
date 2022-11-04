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
        Schema::create('order_history', function (Blueprint $table) {
            // $table->id();
            // $table->integer('cus_id');
            // $table->integer('order_id');
            // $table->integer('state_order');
            // $table->timestamps();
            $table->increments('his_id');
            $table->integer('cus_id')->unsigned();
            $table->foreign('cus_id')->references('cus_id')->on('customer');
            $table->integer('order_id')->unsigned(); 
            $table->foreign('order_id')->references('order_id')->on('order');
            $table->integer('state_order');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_history');
    }
};
