<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
        	'name' => 'Sweatshirt',
            'slug' => 'sweatshirt',
        	'path_image' => 'https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/13.jpg',
        	'price' => 139,
        	'stock' => 100,
        	'category_id' => 3
        ]);

        DB::table('products')->insert([
        	'name' => 'Grey blouse',
            'slug' => 'grey-blouse',
        	'path_image' => 'https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/14.jpg',
        	'price' => 99,
        	'stock' => 100,
        	'category_id' => 3
        ]);

        DB::table('products')->insert([
        	'name' => 'Denim Shirt',
            'slug' => 'denim-shirt',
        	'path_image' => 'https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12.jpg',
        	'price' => 139,
        	'stock' => 100,
        	'category_id' => 2
        ]);

        DB::table('products')->insert([
        	'name' => 'Black Jacket',
            'slug' => 'black-jacket',
        	'path_image' => 'https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/15.jpg',
        	'price' => 139,
        	'stock' => 100,
        	'category_id' => 4
        ]);
    }
}
