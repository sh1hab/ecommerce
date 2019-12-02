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
            $product->addMediaFromUrl('http://demo.weblizar.com/explora-premium/wp-content/uploads/sites/81/2016/09/dummy-product_2.png')
                ->toMediaCollection('products');
        }

    }
}
