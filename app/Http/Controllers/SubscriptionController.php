<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;
use App\Models\User;
class SubscriptionController extends Controller
{
    public function Subscribe(SubscriptionRequest $request)
    {
        $user = User::find(1);
        // return response()->json($user);
        if($user->subscription)
            return response()->json(['message' => 'User already subscribed.']);

        $subscription = $user->subscription()->create($request->validated());

        return response()->json([
            'message' => 'User subscribed successfully.',
            'data' => $subscription]
        , 201);

    }

    public function Unsubscribe(Request $request, $subscriptionId)
    {
        $subscription = Subscription::find($subscriptionId);
        if(!$subscription)
            return response()->json(['message' => ['User has no subscription!']]);

        $user = User::find($subscription->user_id);
        $user->subscription()->delete();

        return response()->json(['message' => 'Subscription cancelled successfully.']);
    }


}
