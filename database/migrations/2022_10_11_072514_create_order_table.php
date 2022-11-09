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
        Schema::create('order', function (Blueprint $table) {
            $table->increments('order_id');
            $table->integer('customer_id');
            $table->timestamp('order_date');
            $table->timestamp('receive_date')->nullable();
            $table->timestamp('cancel_date')->nullable();
            $table->tinyInteger('type_payment');
            $table->decimal('total_price');
            $table->text('description')->nullable();
            $table->integer('state');
            $table->timestamps();
            // $table->increments('order_id', 20);
            // $table->timestamp('order_date');
            // $table->timestamp('receive_date')->nullable();
            // $table->tinyInteger('type_payment');
            // $table->decimal('total_price', 20);
            // $table->text('description')->nullable();
            // $table->integer('sta_id')->unsigned();
            // $table->foreign('sta_id')->references('sta_id')->on('order_state');
            // $table->integer('cus_id')->unsigned(); 
            // $table->foreign('cus_id')->references('cus_id')->on('customer');
            // $table->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
};
