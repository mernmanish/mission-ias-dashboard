<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->string('event_name')->nullable();
            $table->string('video_link')->nullable();
            $table->string('source_type')->nullable();
            $table->string('image_link')->nullable();
            $table->text('description')->nullable();
            $table->string('access')->nullable();
            $table->integer('status')->nullable()->default(1);
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
        Schema::dropIfExists('events');
    }
}
