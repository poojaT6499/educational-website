<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('chapter_id');
            $table->string('media_type');
            $table->string('media_url');
            $table->string('title');
            $table->tinyInteger('is_demo')->default(1); //0-no 1-yes
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects');

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
        Schema::dropIfExists('medias');
    }
}
