<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreProductRequest;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController

{
    use AuthorizesRequests, ValidatesRequests;
    public function uploadImage(StoreProductRequest $request)
    {
        if (!$request->hasFile('image')) {
            return null; // Ensure a clear return value
        }

        $file = $request->file('image');
        
        $path = $file->store('uploads', 'public'); // Store image in public disk
        
        // Generate the full URL
        return Storage::url($path);
    }
}