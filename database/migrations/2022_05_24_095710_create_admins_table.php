<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('gender')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('dist_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('pin_code')->nullable();
            $table->string('full_address')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->integer('cu_id')->nullable();
            $table->integer('mu_id')->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('admins')->insert(
            [
                'name'=>'Admin User',
                'email'=>'test@gmail.com',
                'mobile'=>'9122390660',
                'status'=>1,
                'password'=>Hash::make('12345678'),
                'gender'=>'Male',
                'pin_code'=>'800001',
                'full_address'=>'Exibition Road, Patna'
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
