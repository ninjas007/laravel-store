<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
        	'name' => 'banner 1',
        	'image' => 'https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%282%29.jpg',
        	'title' => 'Learn Bootstrap 4',
        	'subtitle' => 'Best & free guide of responsive web design The most comprehensive tutorial for the Bootstrap 4. Loved by over 500 000 users. Video and written versions available. Create your own, stunning website. Previous',
        	'is_button' => 1,
        	'text_button' => 'FREE TUTORIAL',
        ]);

        DB::table('banners')->insert([
        	'name' => 'banner 2',
        	'image' => 'https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%285%29.jpg',
        	'title' => 'Learn Bootstrap 4',
        	'subtitle' => 'Best & free guide of responsive web design The most comprehensive tutorial for the Bootstrap 4. Loved by over 500 000 users. Video and written versions available. Create your own, stunning website. Previous',
        	'is_button' => 1,
        	'text_button' => 'FREE TUTORIAL',
        ]);
    }
}
