<?php

namespace App\Http\Controllers\API\OurNews;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\OurNews\OurNewsRequest;
use App\Models\OurNews;
use App\Traits\ApiResponse;

class OurNewsController extends Controller
{
    use ApiResponse;
    public function __invoke(OurNewsRequest $request)
    {
        $subscription = OurNews::firstOrCreate($request->validated());
        return $this->success(200, 'User subscribed to our news successfully.', $subscription);

    }
}
