<?php

use App\Models\Page;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentIdToPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->unsignedInteger('parent_id')->after('id')->nullable();
            $table->foreign('parent_id')->references('id')->on('pages')->onDelete('set null');
        });

        $groups = Page::query()
            ->groupBy('page_type')
            ->groupBy('slug')
            ->select(['page_type', 'slug'])
            ->get();

        foreach ($groups as $group) {
            $first_page = Page::query()
                ->where([
                    ['page_type', $group->page_type],
                    ['slug', $group->slug],
                ])
                ->orderBy('id', 'ASC')
                ->first();

            Page::query()
                ->where([
                    ['page_type', $group->page_type],
                    ['slug', $group->slug],
                    ['id', '<>', $first_page->id]
                ])
                ->update(['parent_id' => $first_page->id]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('parent_id');
        });
    }
}
