<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyFkImageTag extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('image_tag', function (Blueprint $table) {
            $table->dropForeign('image_tag_image_id_foreign');
            $table->dropForeign('image_tag_tag_id_foreign');

            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }
}
