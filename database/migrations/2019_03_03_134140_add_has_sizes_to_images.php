<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHasSizesToImages extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('images', function (Blueprint $table) {
            $table->tinyInteger('has_sizes')->default(0)->after('has_high_res');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('has_sizes');
        });
    }
}
