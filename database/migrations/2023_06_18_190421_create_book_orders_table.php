<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('book_id');
            $table->string('full_address')->nullable();
            $table->string('land_mark')->nullable();
            $table->bigInteger('pin_code')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->enum('order_status',['new','accepted','out_of_delivery','delivered'])->nullable()->default('new');
            $table->enum('payment_mode',['cod','online'])->nullable()->default('cod');
            $table->enum('payment_status',['paid','unpaid'])->nullable()->default('unpaid');
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
        Schema::dropIfExists('book_orders');
    }
}
