<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   

        User::create([
            'name' => "YourName",
            'email' => "test1@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make("asdffdsa"), // password
            'remember_token' => Str::random(10),
        ]);
        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(GallerySeeder::class);
    }
}
