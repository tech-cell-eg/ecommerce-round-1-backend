<?php

namespace App\Http\Controllers\API\OurNews;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\OurNews\OurNewsRequest;
use App\Models\OurNews;

class OurNewsController extends Controller
{
    public function __invoke(OurNewsRequest $request)
    {
        $subscription = OurNews::create($request->validated());

        return response()->json([
            'message' => 'User subscribed to our news successfully.',
            'data' => $subscription]
        , 201);
    }
}
