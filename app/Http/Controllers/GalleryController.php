<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{   

    public function __construct(){
        return $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            "post_id"=>"required|exists:posts,id",
            "galleries"=>"required",
            "galleries.*"=>"file|mimes:jpg,png,jpeg|max:5000",
        ]);
        if($request->hasFile("galleries")){
            foreach($request->File("galleries") as $file){
                $newName="gallery".uniqid().".".$file->extension();
                $file->storeAs("public/gallery",$newName);

                $gallery=new Gallery();
                $gallery->post_id=$request->post_id;
                $gallery->user_id=auth()->user()->id;
                $gallery->photo=$newName;
                $gallery->save();
            }
        }
        return redirect()->to(url()->previous()."#img-ui");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        Storage::delete("public/gallery/$gallery");
        $gallery->delete();

        return redirect()->to(url()->previous()."#img-ui");

    }
}
