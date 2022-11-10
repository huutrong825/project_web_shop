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
        Schema::create('order_detail', function (Blueprint $table) {
           
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('quanity_order');
            $table->decimal('price');
            $table->integer('discount')->nullable();
            $table->timestamps();
            $table->softDeletes();
            // $table->increments('detail_id', 20);
            // $table->integer('order_id')->unsigned();
            // $table->foreign('order_id')->references('order_id')->on('order');
            // $table->integer('product_id')->unsigned(); 
            // $table->foreign('product_id')->references('product_id')->on('product');
            // $table->integer('quanity_order');
            // $table->decimal('price', 20);
            // $table->integer('discount')->nullable();
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
        Schema::dropIfExists('order_detail');
    }
};
