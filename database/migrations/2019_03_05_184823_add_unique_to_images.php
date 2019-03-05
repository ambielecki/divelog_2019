<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueToImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->char('file_name_2', 100)->after('file_name');
        });

        DB::statement('UPDATE `images` SET `file_name_2` = `file_name` WHERE `id` = `id`');

        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('file_name');
            $table->renameColumn('file_name_2', 'file_name');
            $table->unique('file_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            //
        });
    }
}
