<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use App\User;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {

    $title=$faker->sentence(6);
    $slug=Str::slug($title);
    $description=$faker->paragraph(4);
    $excerpt=Str::words($description,150);
    return [
        'title'=>$title,
        'slug'=>$slug,
        'description'=>$description,
        'excerpt'=>$excerpt,
        'cover'=>'',
        'user_id'=>User::all()->random()->id,
    ];
});
