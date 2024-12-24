<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function applyCoupon(Request $request)
{
    $coupon = Coupon::where('code', $request->input('code'))->first();

    if (!$coupon) {
        return response()->json(['message' => 'Coupon not found'], 404);
    }

    if (!$coupon->isValid()) {
        return response()->json(['message' => 'Coupon is invalid or expired'], 400);
    }

    // Apply the discount logic here
    $coupon->increment('current_usage');
    return response()->json(['message' => 'Coupon applied successfully']);
}

}
