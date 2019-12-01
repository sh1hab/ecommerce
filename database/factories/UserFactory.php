<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

//$table->bigIncrements('id');
//$table->string('name');
//$table->string('email')->unique();
//$table->string('phone_number',32)->unique();
//$table->string('password',128);
//$table->bigInteger('reward_points')->default(0);
//$table->tinyInteger('email_verified')->default(0);
//$table->timestamp('email_verified_at')->nullable();
//$table->string('google_id')->nullable();
//$table->string('facebook_id')->nullable();
//$table->rememberToken();

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone_number'=>$faker->phoneNumber,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
