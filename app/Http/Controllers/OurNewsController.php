<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OurNewsRequest;
use App\Models\OurNews;
use App\Models\User;
class OurNewsController extends Controller
{
    public function __invoke(OurNewsRequest $request)
    {
        $user = User::find(1);
        // if($request->email==$user->email)
        //     return response()->json(['message' => 'User already subscribed to our news.']);

        $subscription = OurNews::create($request->validated());

        return response()->json([
            'message' => 'User subscribed to our news successfully.',
            'data' => $subscription]
        , 201);

    }


}
