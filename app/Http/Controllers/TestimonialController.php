<?php

namespace App\Http\Controllers;
use App\Models\Testimonials;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function getTestimonialsByProduct($productId)
    {
        $testimonials = Testimonial::with('product')
            ->where('product_id', $productId)
            ->get();
        return response()->json($testimonials);
    }
}
