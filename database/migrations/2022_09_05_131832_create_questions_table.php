<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chapter_id');
            $table->string('name');
            $table->integer('marks');
            $table->tinyInteger('difficulty_level')->nullable();
            $table->tinyInteger('type')->unsigned()->default(\App\Models\Question::WRITTEN); // default set to 'written'  - 2
            $table->tinyInteger('status')->default(1); //0-inactive 1-active
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('questions');
    }
}
