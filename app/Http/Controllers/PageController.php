<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Log\Logger;

class PageController extends Controller
{
    public function index(){
        $posts=Post::latest()->paginate(10);
        return view("index",compact("posts"));
    }

    public function detail($slug){
        $post=Post::where("slug","$slug")->with(['comments','galleries'])->firstOrFail();
        return view("post.detail",compact("post"));
    }

    public function log(){
        
        dispatch(function(){
            logger("This is Logger");
        })->delay(now()->addSecond(5));
    }
}

