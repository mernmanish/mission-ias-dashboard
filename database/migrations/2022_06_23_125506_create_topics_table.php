<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->integer('sub_id')->nullable();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('cu_id')->nullable();
            $table->integer('mu_id')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('mip_address')->nullable();
            $table->integer('status')->nullable()->default(1);
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
        Schema::dropIfExists('topics');
    }
}
