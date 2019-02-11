<?php

use App\Models\Page;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $page = new Page();
        $page->page_type = 'home';
        $page->title = 'Dive Log Repeat - Home';
        $page->slug = '/';
        $page->content = [
            'title'           => 'Here is a test title',
            'content'         => 'Here is some test content',
            'hero_image'      => [
                'path'    => '/images/test_images/hero_test.jpg',
                'title'   => 'DiveLogRepeat',
                'caption' => 'Hero Caption',
            ],
            'carousel_images' => [
                [
                    'path'    => '/images/test_images/home_1.jpg',
                    'title'   => 'Test 1',
                    'caption' => 'Test Caption 1',
                ],
                [
                    'path'    => '/images/test_images/home_2.jpg',
                    'title'   => 'Test 2',
                    'caption' => 'Test Caption 2',
                ],
                [
                    'path'    => '/images/test_images/home_3.jpg',
                    'title'   => 'Test 3',
                    'caption' => 'Test Caption 3',
                ],
            ],

        ];
        $page->revision = 1;
        $page->is_active = true;
        $page->save();
    }
}
