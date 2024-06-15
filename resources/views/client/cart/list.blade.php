@extends('client.layouts.master')

@section('title')
    List Cart
@endsection

@section('content')
    <!-- page title area start -->
    <section class="page__title p-relative d-flex align-items-center"
        data-background="{{ asset('client/assets/img/page-title/page-title-1.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page__title-inner text-center">
                        <h1>Your Cart</h1>
                        <div class="page__title-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Cart</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page title area end -->

    <!-- Cart Area Strat-->
    <section class="cart-area pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {{-- <form action="" method="POST">
                        @csrf --}}
                    <div class="table-content table-responsive">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Images</th>
                                    <th class="cart-product-name">Product</th>
                                    <th class="product-price">Unit Price</th>
                                    <th class="product-price">Price Sale</th>
                                    <th class="product-price">Color</th>
                                    <th class="product-price">Size</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session()->has('cart'))
                                    @foreach (session('cart') as $item)
                                        {{-- @php
                                                // Chuyển sang object
                                                $item = collect($item);
                                            @endphp --}}
                                        <tr>
                                            <td class="product-thumbnail"><a href=""><img width="100"
                                                        src="{{ Storage::url($item['image_thumbnail']) }}"
                                                        alt=""></a>
                                            </td>
                                            <td class="product-name"><a href="product-details.html">{{ $item['name'] }}</a>
                                            </td>
                                            <td class="product-price"><span
                                                    class="amount">{{ number_format($item['price_regular']) }}đ</span>
                                            </td>
                                            <td class="product-price"><span
                                                    class="amount">{{ number_format($item['price_sale']) }}đ</span>
                                            </td>
                                            <td>
                                                {{ $item['color']['name'] }}
                                            </td>
                                            <td>
                                                {{ $item['size']['name'] }}
                                            </td>
                                            <td class="product-quantity">
                                                <div class="cart-plus-minus"><input type="text" value="1" />
                                                </div>
                                            </td>
                                            <td class="product-subtotal"><span class="amount">$130.00</span></td>
                                            <td class="product-remove"><a href="#"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="coupon-all">
                                <div class="coupon">
                                    <input id="coupon_code" class="input-text" name="coupon_code" value=""
                                        placeholder="Coupon code" type="text">
                                    <button class="os-btn os-btn-black" name="apply_coupon" type="submit">Apply
                                        coupon</button>
                                </div>
                                <div class="coupon2">
                                    <button class="os-btn os-btn-black" name="update_cart" type="submit">Update
                                        cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Cart totals</h2>
                                <ul class="mb-20">
                                    <li>Subtotal <span>$250.00</span></li>
                                    <li>Total <span>$250.00</span></li>
                                </ul>
                                <a class="os-btn" href="{{ route('order.checkout') }}">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Area End-->
@endsection
