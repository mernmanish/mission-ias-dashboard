<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_attempts', function (Blueprint $table) {
            $table->id();
            $table->integer('test_id');
            $table->integer('user_id');
            $table->time('attempt_time')->nullable();
            $table->integer('question_id')->nullable();
            $table->string('answer')->nullable();
            $table->string('correct_answer')->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->timestamps();
            $table->index('test_id');
            $table->index('user_id');
            $table->index('question_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_attempts');
    }
}
