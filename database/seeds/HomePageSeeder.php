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
            'title'           => 'This Site Is Currently Under Construction',
            'content'         => '<p>Hello, and welcome to my work in progress dive focused site.  My name is Andrew, and I am web developer with a love of scuba diving.  I am a PADI Advanced Open Water diver, who no longer gets out as much as he would like to, but still still has a keen interest in the hobby</p>' .
                                '<p>This site is very much in progress and is also a part time hobby, currently the only functionality is a highlightable set of PADI tables, but hopefully soon the dive calculator and divelog will be functional.</p>',
            'hero_image'      => [
                'id' => 1,
                'path'    => '/images/test_images/hero_test.jpg',
                'title'   => 'Welcome to DiveLogRepeat',
                'caption' => 'Hero Caption',
            ],
//            'carousel_images' => [
//                [
//                    'path'    => '/images/test_images/home_1.jpg',
//                    'title'   => 'Test 1',
//                    'caption' => 'Test Caption 1',
//                ],
//                [
//                    'path'    => '/images/test_images/home_2.jpg',
//                    'title'   => 'Test 2',
//                    'caption' => 'Test Caption 2',
//                ],
//                [
//                    'path'    => '/images/test_images/home_3.jpg',
//                    'title'   => 'Test 3',
//                    'caption' => 'Test Caption 3',
//                ],
//            ],

        ];
        $page->revision = 1;
        $page->is_active = true;
        $page->save();
    }
}
