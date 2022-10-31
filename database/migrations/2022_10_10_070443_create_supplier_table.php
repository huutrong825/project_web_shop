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
        Schema::create('supplier', function (Blueprint $table) {
            $table->increments('id');
            $table->string('supplier_name');
            $table->string('phone');
            $table->string('address');
            $table->tinyInteger('is_state')->default(1);
            $table->timestamps();
            // $table->increments('sup_id', 20);
            // $table->string('sup_name', 255);
            // $table->string('phone', 25);
            // $table->string('address', 255);
            // $table->tinyInteger('is_state')->default(1);
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
        Schema::dropIfExists('supplier');
    }
};
