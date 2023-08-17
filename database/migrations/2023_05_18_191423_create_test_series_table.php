<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_series', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->integer('subcategory_id');
            $table->string('test_series_name')->nullable();
            $table->decimal('price')->default('0.00')->nullable();
            $table->time('time')->nullable();
            $table->string('post_by')->nullable();
            $table->string('image_link')->nullable();
            $table->string('test_category')->nullable();
            $table->string('no_of_question')->nullable();
            $table->text('description')->nullable();
            $table->enum('is_support_negative', ['yes', 'no'])->nullable()->default('yes');
            $table->decimal('negative_marks')->nullable()->default('0.00');
            $table->string('access')->nullable();
            $table->string('test_type')->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->timestamps();
            $table->index('course_id');
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
        Schema::dropIfExists('test_series');
    }
}
