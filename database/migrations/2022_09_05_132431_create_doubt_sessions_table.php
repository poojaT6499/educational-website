<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoubtSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doubt_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('chapter_id');
            $table->string('title');
            $table->string('link');
            $table->dateTime('schedule_time');
            $table->string('platform');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('teacher_id')
                ->references('id')
                ->on('teachers');

            $table->foreign('chapter_id')
                ->references('id')
                ->on('chapters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doubt_sessions');
    }
}
