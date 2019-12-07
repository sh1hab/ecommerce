<?php

use Illuminate\Database\Seeder;
//use Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Product::class,20)->create();

//        $faker = new Faker();

        $products = \App\Models\Product::select('id')->get();

        foreach ( $products as $key => $product ){
            $product->addMediaFromUrl('https://lorempixel.com/640/480/?75974')
                ->toMediaCollection('products');
        }

    }
}
