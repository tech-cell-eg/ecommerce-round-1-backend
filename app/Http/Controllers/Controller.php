<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


abstract class Controller
{
    public function uploadImage(Request $request){
        if(!$request->hasFile('image')){
            return;
        }
            $file=$request->file('image');
            $path=$file->store('uploads','public'); // store image in public Disk
            return $path;
}
}
