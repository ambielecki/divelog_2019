<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageTagTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('image_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('image_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();
            $table->foreign('image_id')->references('id')->on('images');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('image_tag');
    }
}
