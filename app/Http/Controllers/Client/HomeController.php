<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $productTrending = Product::query()
            ->where(['status' => 'publish', 'is_hot_deal' => 1])
            ->latest('id')->limit(4)->get();

        $productSale = Product::query()
            ->where('status', 'publish')
            ->whereNotNull('price_sale')->latest('id')->limit(5)->get();

        return view('client.home', compact('productTrending', 'productSale'));
    }
}
