<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
 protected $fillable=["message","user_id","post_id"];

 public function User(){
     return $this->belongsTo(User::class);
 }
}
