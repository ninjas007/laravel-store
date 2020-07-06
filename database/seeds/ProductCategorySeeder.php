<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            'uuid' => (string) Str::uuid(),
        	'name' => 'All',
            'sort_list' => 0,
            'slug' => 'all'
        ]);

        DB::table('product_categories')->insert([
            'uuid' => (string) Str::uuid(),
        	'name' => 'Shirts',
            'sort_list' => 1,
            'slug' => 'shirts'
        ]);

        DB::table('product_categories')->insert([
            'uuid' => (string) Str::uuid(),
        	'name' => 'Sport wears',
            'sort_list' => 2,
            'slug' => 'sport-wears'
        ]);

        DB::table('product_categories')->insert([
            'uuid' => (string) Str::uuid(),
        	'name' => 'Outwears',
            'sort_list' => 3,
            'slug' => 'outwears'
        ]);
    }
}
