<header>
    <div id="header-sticky" class="header__area grey-bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4">
                    <div class="logo">
                        <a href="index.html"><img src="{{ asset('client/assets/img/logo/logo.png') }}" alt="logo"></a>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8">
                    <div class="header__right p-relative d-flex justify-content-between align-items-center">
                        <div class="main-menu d-none d-lg-block">
                            <nav>
                                <ul>
                                    <li class="active has-dropdown"><a href="index.html">Home</a>
                                        <ul class="submenu transition-3">
                                            <li><a href="index.html">Home Style 1</a></li>
                                            <li><a href="index-2.html">Home Style 2</a></li>
                                            <li><a href="index-3.html">Home Style 3</a></li>
                                            <li><a href="index-4.html">Home Style 4</a></li>
                                            <li><a href="index-5.html">Home Style 5</a></li>
                                            <li><a href="index-6.html">Home Style 6</a></li>
                                            <li><a href="index-7.html">Home Style 7</a></li>
                                        </ul>
                                    </li>
                                    <li class="mega-menu has-dropdown"><a href="shop.html">Shop</a>
                                        <ul class="submenu transition-3"
                                            data-background="assets/img/bg/mega-menu-bg.jpg')}}">
                                            <li class="has-dropdown">
                                                <a href="shop.html">Shop Pages</a>
                                                <ul>
                                                    <li><a href="shop.html">Standard Shop Page</a></li>
                                                    <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a>
                                                    </li>
                                                    <li><a href="shop-4-col.html">Shop 4 Column</a></li>
                                                    <li><a href="shop-3-col.html">Shop 3 Column</a></li>
                                                    <li><a href="shop.html">Shop Page</a></li>
                                                    <li><a href="shop.html">Shop Page </a></li>
                                                    <li><a href="shop.html">Shop Infinity</a></li>
                                                </ul>
                                            </li>
                                            <li class="has-dropdown">
                                                <a href="shop.html">Products Pages</a>
                                                <ul>
                                                    <li><a href="product-details.html">Product Details</a></li>
                                                    <li><a href="product-details.html">Product Page V2</a></li>
                                                    <li><a href="product-details.html">Product Page V3</a></li>
                                                    <li><a href="product-details.html">Product Page V4</a></li>
                                                    <li><a href="product-details.html">Simple Product</a></li>
                                                    <li><a href="product-details.html">Variable Product</a></li>
                                                    <li><a href="product-details.html">External Product</a></li>
                                                </ul>
                                            </li>
                                            <li class="has-dropdown">
                                                <a href="shop.html">Other Shop Pages</a>
                                                <ul>
                                                    <li><a href="wishlist.html">Wishlist</a></li>
                                                    <li><a href="cart.html">Shopping Cart</a></li>
                                                    <li><a href="checkout.html">Checkout</a></li>
                                                    <li><a href="register.html">Register</a></li>
                                                    <li><a href="login.html">Login</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-dropdown"><a href="blog.html">Blog</a>
                                        <ul class="submenu transition-3">
                                            <li><a href="blog.html">Blog</a></li>
                                            <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                            <li><a href="blog-no-sidebar.html">Blog No Sidebar</a></li>
                                            <li><a href="blog-2-col.html">Blog 2 Column</a></li>
                                            <li><a href="blog-2-col-mas.html">BLog 2 Col Masonary</a></li>
                                            <li><a href="blog-3-col.html">Blog 3 Column</a></li>
                                            <li><a href="blog-details.html">Blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-dropdown"><a href="shop.html">Pages</a>
                                        <ul class="submenu transition-3">
                                            <li><a href="wishlist.html">Wishlist</a></li>
                                            <li><a href="cart.html">Shopping Cart</a></li>
                                            <li><a href="checkout.html">Checkout</a></li>
                                            <li><a href="account.html">My Account</a></li>
                                            <li><a href="register.html">Register</a></li>
                                            <li><a href="login.html">Login</a></li>
                                            <li><a href="error.html">Error 404</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="mobile-menu-btn d-lg-none">
                            <a href="javascript:void(0);" class="mobile-menu-toggle"><i class="fas fa-bars"></i></a>
                        </div>
                        <div class="header__action">
                            <ul>
                                <li><a href="#" class="search-toggle"><i class="ion-ios-search-strong"></i>
                                        Search</a></li>
                                <li><a href="javascript:void(0);" class="cart"><i class="ion-bag"></i> Cart
                                        <span>(01)</span></a>
                                    <div class="mini-cart">
                                        <div class="mini-cart-inner">
                                            <ul class="mini-cart-list">
                                                <li>
                                                    <div class="cart-img f-left">
                                                        <a href="product-details.html">
                                                            <img src="{{ asset('client/assets/img/shop/product/cart-sm/16.jpg') }}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="cart-content f-left text-left">
                                                        <h5>
                                                            <a href="product-details.html">Consectetur adi </a>
                                                        </h5>
                                                        <div class="cart-price">
                                                            <span class="ammount">1 <i class="fal fa-times"></i></span>
                                                            <span class="price">$ 400</span>
                                                        </div>
                                                    </div>
                                                    <div class="del-icon f-right mt-30">
                                                        <a href="#">
                                                            <i class="fal fa-times"></i>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="cart-img f-left">
                                                        <a href="product-details.html">
                                                            <img src="{{ asset('client/assets/img/shop/product/cart-sm/17.jpg') }}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="cart-content f-left text-left">
                                                        <h5>
                                                            <a href="product-details.html">Wooden container Bowl
                                                            </a>
                                                        </h5>
                                                        <div class="cart-price">
                                                            <span class="ammount">1 <i
                                                                    class="fal fa-times"></i></span>
                                                            <span class="price">$ 400</span>
                                                        </div>
                                                    </div>
                                                    <div class="del-icon f-right mt-30">
                                                        <a href="#">
                                                            <i class="fal fa-times"></i>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="cart-img f-left">
                                                        <a href="product-details.html">
                                                            <img src="{{ asset('client/assets/img/shop/product/cart-sm/18.jpg') }}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="cart-content f-left text-left">
                                                        <h5>
                                                            <a href="product-details.html">Black White Towel </a>
                                                        </h5>
                                                        <div class="cart-price">
                                                            <span class="ammount">1 <i
                                                                    class="fal fa-times"></i></span>
                                                            <span class="price">$ 400</span>
                                                        </div>
                                                    </div>
                                                    <div class="del-icon f-right mt-30">
                                                        <a href="#">
                                                            <i class="fal fa-times"></i>
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="total-price d-flex justify-content-between mb-30">
                                                <span>Subtotal:</span>
                                                <span>$400.0</span>
                                            </div>
                                            <div class="checkout-link">
                                                <a href="cart.html" class="os-btn">view Cart</a>
                                                <a class="os-btn os-btn-black" href="checkout.html">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li> <a href="javascript:void(0);"><i class="far fa-bars"></i></a>
                                    <ul class="extra-info">
                                        <li>
                                            <div class="my-account">
                                                <ul>
                                                    @guest
                                                        @if (Route::has('login'))
                                                            <li class="nav-item">
                                                                <a class="nav-link"
                                                                    href="{{ route('login') }}">{{ __('Login') }}</a>
                                                            </li>
                                                        @endif

                                                        @if (Route::has('register'))
                                                            <li class="nav-item">
                                                                <a class="nav-link"
                                                                    href="{{ route('register') }}">{{ __('Register') }}</a>
                                                            </li>
                                                        @endif
                                                    @else
                                                        <li class="nav-item">
                                                            <h5> Hello:
                                                                {{ Auth::user()->name }}</h5>
                                                        </li>

                                                        <li class="nav-item">
                                                            <a href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                                                                 document.getElementById('logout-form').submit();">
                                                                {{ __('Logout') }}
                                                            </a>

                                                            <form id="logout-form" action="{{ route('logout') }}"
                                                                method="POST" class="d-none">
                                                                @csrf
                                                            </form>
                                                        </li>
                                                    @endguest
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
