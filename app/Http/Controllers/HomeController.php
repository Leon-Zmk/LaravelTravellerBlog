<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    
    public function edit(){
        return view("profile.edit");
    }

    public function update(Request $request){
        $request->validate([
            'name'=> "required",
            'photo'=>"nullable|file|mimes:jpeg,png|max:5000",
        ]);

        if($request->hasFile("photo")){
            $newName="profile_".uniqid().".".$request->file("photo")->extension();
            $request->file("photo")->storeAs("public/profile",$newName);
        }

        $user=User::find(auth()->user()->id);
        $user->name=$request->name;
        
        if($request->hasFile('photo')){
            $user->photo=$newName;
        }
        $user->update();

        return redirect()->back();
    }

    public function editPassword(){
        return view("profile.password");
    }

    public function updatePassword(Request $request){

        $request->validate([
            'old_password'=>"required|min:6",
            'password'=>"required|min:6|max:100",
            'confirm_password'=>"required|min:6|max:100|same:password",
        ]);
        if(!Hash::check($request->old_password,auth()->user()->password)){
            return redirect()->back()->withErrors(["old_password"=>"Password Incorrect"]);
        }
        $user=User::find(auth()->user()->id);
        $user->password=Hash::make($request->password);
        $user->update();

        Auth::logout();
        return redirect()->route("login");
    }
}
