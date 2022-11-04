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
        Schema::create ('user_cus', function (Blueprint $table) {
            // $table->increments('id');
            // $table->string('name');
            // $table->string('email')->unique();
            // $table->string('password');
            // $table->string('avatar')->nullable();
            // $table->string('sex',5)->nullable();
            // $table->string('phone')->nullable();
            // $table->date('birth')->nullable();
            // $table->string('address')->nullable();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->rememberToken(); 
            // $table->timestamp('last_login_at')->nullable();
            // $table->timestamps();
                $table->increments('usc_id', 20);
                $table->string('name', 255);
                $table->string('email', 255)->unique();
                $table->string('password', 255);
                $table->string('avatar', 255)->nullable();
                $table->tinyInteger('sex')->nullable();
                $table->string('phone', 25)->nullable();
                $table->date('birth', 25)->nullable();
                $table->string('address', 255)->nullable();
                $table->timestamp('email_verified_at')->nullable();
                $table->rememberToken(); 
                $table->timestamp('last_login_at')->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_user');
    }
};
