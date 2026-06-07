<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
{
    $products     = Product::with('category')->get();
    $testimonials = \App\Models\Testimonial::where('is_active', true)->latest()->take(3)->get();
    return view('home', compact('products', 'testimonials')); // sesuaikan nama view-nya
}
    public function indexOrder()
{
    $products = \App\Models\Product::all();

    return view('order', compact('products'));
}
}