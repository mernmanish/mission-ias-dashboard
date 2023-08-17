<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_stats', function (Blueprint $table) {
            $table->id();
            $table->integer('test_id');
            $table->integer('user_id');
            $table->integer('test_attempt_id');
            $table->time('attempt_time')->nullable();
            $table->integer('total_attempt')->nullable();
            $table->integer('correct_answer')->nullable();
            $table->integer('wrong_answer')->nullable();
            $table->integer('not_attempt')->nullable();
            $table->decimal('overall_score',10,2)->default(0.00)->nullable();
            $table->decimal('accuracy',10,2)->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->timestamps();
            $table->index('test_id');
            $table->index('user_id');
            $table->index('test_attempt_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_stats');
    }
}
