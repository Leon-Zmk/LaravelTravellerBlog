<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Facades\Image;

class CreateFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $newFileName;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($newFileName)
    {
        $this->newFileName=$newFileName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $img=Image::make(public_path("storage/cover/".$this->newFileName));
        $img->fit(300,300)->save(public_path('storage/cover/square_'.$this->newFileName));
        

        $img=Image::make(public_path("storage/cover/".$this->newFileName));
        $img->resize(300,null,function($constrain){
              $constrain->aspectRatio();
        })->save(public_path('storage/cover/preview_'.$this->newFileName));


        $img=Image::make(public_path("storage/cover/".$this->newFileName));
        $img->resize(1024,null,function($constrain){
              $constrain->aspectRatio();
        })->save(public_path('storage/cover/large_'.$this->newFileName));
    }
}
