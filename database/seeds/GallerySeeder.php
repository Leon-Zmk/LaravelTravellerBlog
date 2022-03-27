<?php

use Illuminate\Database\Seeder;
use App\Gallery;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Factory(Gallery::class,10)->create();
    }
}
