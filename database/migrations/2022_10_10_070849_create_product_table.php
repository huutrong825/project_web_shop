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
        Schema::create('product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('product_name');
            $table->integer('category_id');
            $table->integer('quanity');
            $table->decimal('unit_price');
            $table->integer('unit');
            $table->text('description');
            $table->string('image');
            $table->decimal('discount');
            $table->integer('supplier_id');
            $table->tinyInteger('is_sale');
            $table->timestamps();
            // $table->increments('product_id', 20);
            // $table->string('product_name', 255);
            // $table->integer('quanity');
            // $table->decimal('unit_price', 20);
            // $table->text('description');
            // $table->string('image', 255)->nullable();
            // $table->tinyInteger('is_sale');
            // $table->tinyInteger('is_delete');
            // $table->integer('dis_id')->unsigned();
            // $table->integer('sup_id')->unsigned();
            // $table->integer('cate_id')->unsigned();
            // $table->integer('unit_id')->unsigned();
 
            // $table->foreign('dis_id')->references('dis_id')->on('discount');
            // $table->foreign('sup_id')->references('sup_id')->on('supplier');
            // $table->foreign('cate_id')->references('cate_id')->on('category');
            // $table->foreign('unit_id')->references('unit_id')->on('unit');
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
        Schema::dropIfExists('product');
    }
};
