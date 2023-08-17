<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->bigInteger('mobile');
            $table->string('image_link')->nullable();
            $table->string('password');
            $table->string('api_token')->nullable();
            $table->string('fcm_token')->nullable();
            $table->enum('status',['active','inactive','block'])->default('active');
            $table->enum('is_login',['yes','no'])->default('no');
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
        Schema::dropIfExists('users');
    }
}
