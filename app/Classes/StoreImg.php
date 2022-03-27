<?php   

namespace App\Classes;


Class StoreImg {


    public static function Store($inputName,$dir){
        $path="public/".$dir;
        $newFileName=$inputName."_".uniqid()."_.".request()->file($inputName)->extension();
        request()->file($inputName)->storeAs($path,$newFileName);

        return $newFileName;
    }

}