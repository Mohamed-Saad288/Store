<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HomeController extends Controller
{
    public function index()
    {


        $products = Product::with('category')
            ->active()
            ->latest()
            ->limit(8)
            ->get();
        return view('front.home',compact('products'));
    }
}
