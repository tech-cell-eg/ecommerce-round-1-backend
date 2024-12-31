<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use OpenApi\Attributes as OA;

abstract class Controller

{
    use AuthorizesRequests, ValidatesRequests;
    public function uploadImage(StoreProductRequest $request){
        if(!$request->hasFile('image')){
            return;
        }
            $file=$request->file('image');
            $path=$file->store('uploads','public'); // store image in public Disk
            return $path;
}
}