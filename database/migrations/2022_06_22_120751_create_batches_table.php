<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->unique();
            $table->integer('course_id')->nullable();
            $table->integer('seats')->nullable();
            $table->string('remarks')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('mip_address')->nullable();
            $table->integer('cu_id')->nullable();
            $table->integer('mu_id')->nullable();
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
        Schema::dropIfExists('batches');
    }
}
