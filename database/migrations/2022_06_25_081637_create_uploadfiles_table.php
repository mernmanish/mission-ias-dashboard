<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploadfiles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
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
        Schema::dropIfExists('uploadfiles');
    }
}
