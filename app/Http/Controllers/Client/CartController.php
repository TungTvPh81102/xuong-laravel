<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add()
    {
        // dd(\request()->all());
        $product = Product::query()->findOrFail(\request('product_id'));

        $productVariant = ProductVariant::query()
            ->with(['color', 'size'])
            ->where('product_id', \request('product_id'))
            ->where('product_size_id', \request('product_size_id'))
            ->where('product_color_id', \request('product_color_id'))
            ->firstOrFail();

        if (!isset(session('cart')[$productVariant->id])) {

            $data = $product->toArray()
                + $productVariant->toArray()
                + ['quantity-add' => \request('quantity')];

            session()->put(
                "cart." . $productVariant->id,
                $data
            );
        } else {
            $data = session('cart')[$productVariant->id];
            $data['quantity-add'] = \request('quantity');
            session()->put(
                "cart." . $productVariant->id,
                $data
            );
        }

        return redirect()->route('cart.list')->with('success', 'Thêm vào giỏ hàng thành công!');
    }

    public function list()
    {
        // dd(session('cart'));
        return view('client.cart.list');
    }
}
