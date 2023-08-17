<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestSeriesQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_series_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('test_id');
            $table->string('test_category');
            $table->text('question')->nullable();
            $table->string('question_image')->nullable();
            $table->text('option_a')->nullable();
            $table->string('option_a_image')->nullable();
            $table->text('option_b')->nullable();
            $table->string('option_b_image')->nullable();
            $table->text('option_c')->nullable();
            $table->string('option_c_image')->nullable();
            $table->text('option_d')->nullable();
            $table->string('option_d_image')->nullable();
            $table->string('answer')->nullable();
            $table->text('solution')->nullable();
            $table->string('solution_image')->nullable();
            $table->timestamps();
            $table->index('test_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_series_questions');
    }
}
