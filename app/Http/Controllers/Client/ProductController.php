<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productDetail($slug)
    {
        $product = Product::query()->with('variants')->where('slug', $slug)->first();

        $galleries = ProductGallery::query()->where('product_id', $product->id)->get();

        $sizes = ProductSize::query()->pluck('name', 'id')->all();

        $colors = ProductColor::query()->pluck('name', 'id')->all();

        return view('client.product-detail', compact('product', 'sizes', 'colors', 'galleries'));
    }
}
