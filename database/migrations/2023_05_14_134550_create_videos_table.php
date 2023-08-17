<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->string('video_title')->nullable();
            $table->string('video_link')->nullable();
            $table->string('source_type')->nullable();
            $table->string('image_link')->nullable();
            $table->string('access')->nullable();
            $table->timestamps();
            $table->index('course_id');
            $table->index('category_id');
            $table->index('subcategory_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
