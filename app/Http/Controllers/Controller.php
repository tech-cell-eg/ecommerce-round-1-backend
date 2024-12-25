<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreProductRequest;
use OpenApi\Attributes as OA;

#[OA\Info(version: "1.0.0", title: "round-1", description: "round-1 doc")]
#[OA\Server(url: "http://127.0.0.1:8000/api")]
#[OA\SecurityScheme(
    securityScheme: "bearerAuth",
    type: "http",
    name: "Authorization",
    in: "header",
    scheme: "bearer"
)]

/**
 * @OA\Components(
 *     @OA\Schema(
 *         schema="ApiResponse",
 *         type="object",
 *         required={"status", "message"},
 *         @OA\Property(
 *             property="status",
 *             type="string",
 *             description="Status of the API response"
 *         ),
 *         @OA\Property(
 *             property="message",
 *             type="string",
 *             description="Message describing the result"
 *         ),
 *         @OA\Property(
 *             property="data",
 *             type="object",
 *             nullable=true,
 *             description="Optional data payload"
 *         )
 *     )
 * )
 */

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