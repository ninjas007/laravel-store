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
        	'price' => 139000,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Et dolor suscipit libero eos atque quia ipsa sint voluptatibus! Beatae sit assumenda asperiores iure at maxime atque repellendus maiores quia sapiente',
        	'stock' => 100
        ]);

        DB::table('products')->insert([
        	'name' => 'Grey blouse',
            'slug' => 'grey-blouse',
        	'path_image' => 'https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/14.jpg',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Et dolor suscipit libero eos atque quia ipsa sint voluptatibus! Beatae sit assumenda asperiores iure at maxime atque repellendus maiores quia sapiente',
        	'price' => 99000,
        	'stock' => 100
        ]);

        DB::table('products')->insert([
        	'name' => 'Denim Shirt',
            'slug' => 'denim-shirt',
        	'path_image' => 'https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12.jpg',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Et dolor suscipit libero eos atque quia ipsa sint voluptatibus! Beatae sit assumenda asperiores iure at maxime atque repellendus maiores quia sapiente',
        	'price' => 139000,
        	'stock' => 100
        ]);

        DB::table('products')->insert([
        	'name' => 'Black Jacket',
            'slug' => 'black-jacket',
        	'path_image' => 'https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/15.jpg',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Et dolor suscipit libero eos atque quia ipsa sint voluptatibus! Beatae sit assumenda asperiores iure at maxime atque repellendus maiores quia sapiente',
        	'price' => 139000,
        	'stock' => 100
        ]);
    }
}
