<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Movie::class, function (Faker $faker) {
    return [
        'title'=>$faker->title,
        'director'=>1,
        'describe'=>$faker->paragraph,
        'rate'=>mt_rand(0,10),
        'release_at'=>$faker->dateTimeBetween('-30 years','now'),
        'created_at'=>$faker->dateTimeBetween('-30 years','now'),
        'updated_at'=>$faker->dateTimeBetween('-30 years','now')
    ];
});
