<?php

/** @var Factory $factory */

use App\Model;
use App\Models\Category;
use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Product::class, function (Faker $faker) {
    return array(
        'category_id'   => Category::all()->random()->id,
        'title'         => $faker->jobTitle,
        'description'   => $faker->realText(),
        'price'         => random_int(99,999),
        'sale_price'    => random_int(0,999)
    );
});
