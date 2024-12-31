<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreProductRequest;
use OpenApi\Attributes as OA;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
abstract class Controller extends BaseController

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