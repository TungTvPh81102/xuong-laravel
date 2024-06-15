<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkOut()
    {
        $cart = session('cart');

        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['quantity'] * ($item['price_sale'] ?: $item['price_regular']);
        }

        return view('client.order.check-out', compact('totalAmount'));
    }

    public function save()
    {
        // dd(\request()->all(),session('cart'));
        try {

            DB::transaction(function () {
                $user = User::query()->create([
                    'name' => \request('user_name'),
                    'email' => \request('user_email'),
                    'password' => bcrypt(\request('user_email')),
                    'is_active' => false,
                ]);

                $cart = session('cart');

                $totalAmount = 0;
                $dataItem = [];
                foreach ($cart as $variantID => $item) {
                    $totalAmount += $item['quantity'] * ($item['price_sale'] ?: $item['price_regular']);

                    $dataItem[] = [
                        'product_variant_id' => $variantID,
                        'quantity' => $item['quantity'],
                        'product_name' => $item['name'] ,
                        'product_sku' => $item['sku'] ,
                        'product_img_thumbnail' => $item['image_thumbnail'] ,
                        'product_price_regular'=> $item['price_regular'] ,
                        'product_price_sale' => $item['price_sale'] ,
                        'variant_size_name' => $item['color']['name'] ,
                        'variant_color_name' => $item['size']['name'] ,
                    ];
                }

                $order =   Order::query()->create([
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'user_email' => $user->email,
                    'user_phone' => \request('user_phone'),
                    'user_address' => \request('user_address'),
                    'total_price' => $totalAmount,
                ]);

                foreach ($dataItem as $item) {
                    $item['order_id'] = $order->id;

                    OrderItem::query()->create($item);
                } 
            });

            session()->forget('cart');

            return redirect()->route('home')->with('success', 'Đặt hàng thành công!');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back()->with('error', $th->getMessage());
        }
    }
}
