<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('file_name');
            $table->text('title');
            $table->text('description');
            $table->tinyInteger('is_hero')->default(0);
            $table->text('aspect_ratio');
            $table->tinyInteger('has_high_res')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('images');
    }
}
