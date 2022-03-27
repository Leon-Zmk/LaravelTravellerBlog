<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $with=['user'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function galleries(){
        return $this->hasMany(Gallery::class);
    }

    public function getTitleAttribute($value){
        return ucwords($value);
    }
}
