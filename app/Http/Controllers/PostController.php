<?php

namespace App\Http\Controllers;

use App\Jobs\CreateFile;
use App\Mail\PostMail;
use App\Post;
use App\Classes\StoreImg;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct(){
         return $this->middleware("auth")->except(["index,show"]);
     }
    public function index()
    {
        return redirect()->route("index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("post.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            "title"=>"required|unique:posts,title|min:5|max:100",
            "description"=>"required|min:10",
            "cover"=> "required|file|mimes:png,jpeg|max:5000",
          ]);

          $newFileName=StoreImg::Store("cover","cover");

          CreateFile::dispatch($newFileName)->delay(now()->addSecond(5));

          $post=new Post();
          $post->title=$request->title;
          $post->slug=Str::slug($request->title);
          $post->description=$request->description;
          $post->excerpt=Str::words($request->description, 30, '...');
          $post->cover=$newFileName;
          $post->user_id=Auth::id();
          $post->save();

        //   $mails=["testingone@gmail.com","testingtwo@gmail.com"];
        //   foreach($mails as $mail){
        //      Mail::to($mail)->later(now()->addSecond(5),new PostMail($post));

    //   }  

        

          return redirect()->route("index");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {   

        return redirect()->route("post.detail",$post->slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {   

        Gate::authorize("update",$post);
        return view("post.edit",compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            "title"=>"required|unique:posts,title,$post->id|min:5|max:100",
            "description"=>"required|min:10",
            "cover"=> "nullable|file|mimes:png,jpeg|max:5000",
          ]);

          if($request->hasFile("cover")){

            Storage::delete("public/cover".$post->cover);


            $newFileName=StoreImg::Store("cover","cover");

            $post->cover=$newFileName;
          }

          $post->title=$request->title;
          $post->slug=Str::slug($request->title);
          $post->description=$request->description;
          $post->excerpt=Str::words($request->description, 50, '...');
          $post->update();

          return redirect()->route("index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        Gate::authorize("delete",$post);

        //delete File First

        Storage::delete("public/cover/$post->cover");

        //galleries storage delete

        foreach($post->galleries as $gallery){
            Storage::delete("public/gallery/$gallery->photo");
        }

         //galleries delete

        $post->galleries()->delete();

       

       

        //delete Post;

        $post->delete();

        return redirect()->route("index");
    }
}
