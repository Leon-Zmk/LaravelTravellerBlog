<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[PageController::class,'index'])->name("index");
Route::get('/detail/{slug}',[PageController::class,'detail'])->name("post.detail");
Route::get("/log",[PageController::class,'log'])->name('log');


Auth::routes();
Auth::routes(["verify"=>true]);

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


        Route::resource('post', PostController::class);
        Route::resource('comment', CommentController::class);
        Route::resource('gallery', GalleryController::class);

Route::prefix("/user")->group(function(){
        Route::get('/edit-profile', 'HomeController@edit')->name('profile.edit');
        Route::put('/update-profile', 'HomeController@update')->name('profile.update');
        Route::get("/edit-password","HomeController@editPassword")->name("profile.epassword");
        Route::post("/update-password","HomeController@updatePassword")->name("profile.upassword");
});


