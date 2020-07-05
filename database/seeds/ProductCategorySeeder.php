<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
        	'name' => 'All'
        ]);

        DB::table('product_categories')->insert([
        	'name' => 'Shirts'
        ]);

        DB::table('product_categories')->insert([
        	'name' => 'Sport wears'
        ]);

        DB::table('product_categories')->insert([
        	'name' => 'Outwears'
        ]);
    }
}
