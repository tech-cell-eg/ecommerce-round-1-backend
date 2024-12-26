<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreProductRequest;
use OpenApi\Attributes as OA;

#[OA\Info(version: "1.0.0", title: "round-1", description: "round-1 doc")]
#[OA\Server(url: "http://127.0.0.1:8000/api", description: "local server")]
#[OA\Server(url: "https://round-one.digital-vision-solutions.com/api", description: "production server")]
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
 *             type="integer",
 *             example=200,
 *             description="Status of the API response"
 *         ),
 *         @OA\Property(
 *             property="message",
 *             type="string",
 *             example="success message",
 *             description="Message describing the result"
 *         ),
 *         @OA\Property(
 *             property="data",
 *             type="object",
 *             nullable=true,
 *             description="Optional data payload"
 *         )
 *     ),
 *     @OA\Schema(
 *         schema="ApiResponse-2",
 *         type="object",
 *         required={"message"},
 *         @OA\Property(
 *             property="message",
 *             type="string",
 *             example="Unauthenticated.",
 *         ),
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