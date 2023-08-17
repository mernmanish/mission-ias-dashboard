<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_chats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('video_id');
            $table->bigInteger('user_id');
            $table->text('message')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->index('video_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_chats');
    }
}
