<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_materials', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->string('writer_name')->nullable();
            $table->string('pdf_title')->nullable();
            $table->integer('price')->nullable();
            $table->string('access')->nullable();
            $table->string('pdf_file')->nullable();
            $table->text('description')->nullable();
            $table->string('image_link')->nullable();
            $table->string('download_option')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('study_materials');
    }
}
