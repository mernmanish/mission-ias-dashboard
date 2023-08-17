<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_courses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('mobile');
            $table->bigInteger('course_id');
            $table->decimal('amount');
            $table->date('join_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->index('user_id');
            $table->index('course_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assign_courses');
    }
}
