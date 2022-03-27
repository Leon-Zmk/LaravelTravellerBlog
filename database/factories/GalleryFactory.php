<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Gallery;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Gallery::class, function (Faker $faker) {

    $post=Post::all()->random();
    return [
        'photo'=>'',
        "user_id"=>$post->user_id,
        "post_id"=>$post->id,
    ];
});
