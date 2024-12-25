<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreProductRequest;


abstract class Controller
{
    public function uploadImage(StoreProductRequest $request){
        if(!$request->hasFile('image')){
            return;
        }
            $file=$request->file('image');
            $path=$file->store('uploads','public'); // store image in public Disk
            return $path;
}
}