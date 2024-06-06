<header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="header-right header-dropdowns ml-0 ml-sm-auto w-sm-100">
                        <div class="header-dropdown dropdown-expanded d-none d-lg-block">
                            <a href="#">Links</a>
                            <div class="header-menu">
                                <ul>
                                    <li><a href="#">Thông tin</a></li>
                                    <li><a href="{{route('wish.index')}}">Yêu thích</a></li>
                                    <li><a href="{{route('cart.index')}}">Giỏ hàng</a></li>
                                </ul>
                            </div>
                            <!-- End .header-menu -->
                        </div>
                        
                        @auth
                        <div class="header-dropdown">
                            <a>{{Auth::user()->name}}</a>
                            <div class="header-menu">
                                <ul>
                                    <li><a href="{{route('profile.index')}}">Tài khoản</a>
                                    </li>
                                    <li><a href="{{ route('logout') }}"></i>Đăng xuất</a></li>
                                </ul>
                            </div>
                            <!-- End .header-menu -->
                        </div>

                        @else
                            <a href="{{ route('login') }}">Đăng nhập</a>
                        @endauth

                        <!-- End .header-dropown -->
                    </div>

                    <span class="separator"></span>

                    <div class="social-icons">
                        <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"></a>
                        <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"></a>
                        <a href="#" class="social-icon social-instagram icon-instagram" target="_blank"></a>
                    </div>
                    <!-- End .header-right -->
                </div>
                <!-- End .container -->
            </div>
            <!-- End .header-top -->

            <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
                <div class="container">
                    <div class="header-left col-lg-2 w-auto pl-0">
                        <button class="mobile-menu-toggler text-primary mr-2" type="button">
							<i class="fas fa-bars"></i>
						</button>
                        <a href="{{route('home')}}" class="logo">
                            <img src="{{url('assets')}}/uploads/logos/fd_logo.png" width="80" height="44" alt="FD logo">
                        </a>
                    </div>
                    <!-- End .header-left -->

                    <div class="header-right w-lg-max">
                        <div class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
                            <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                            <form action="{{route('search-product')}}" method="post">
                                @csrf
                                <div class="header-search-wrapper">
                                    <input type="search" name="search" class="form-control" id="q" placeholder="Tìm kiếm sản phẩm..." required>
                                    <button class="btn icon-magnifier p-0" title="search" type="submit"></button>
                                </div>
                                <!-- End .header-search-wrapper -->
                            </form>
                        </div>
                        <!-- End .header-search -->

                        <div class="header-contact d-none d-lg-flex pl-4 pr-4">
                            <img alt="phone" src="{{url('assets')}}/images/phone.png" width="30" height="30" class="pb-1">
                            <h6><span>Liên hệ ngay</span><a href="tel:#" class="text-dark font1">094 123 4567</a></h6>
                        </div>
                        @auth
                        <a href="{{route('profile.index')}}" class="header-icon"><i class="icon-user-2"></i></a>

                        @else
                        <a href="{{route('login')}}" class="header-icon"><i class="icon-user-2"></i></a>
                        @endauth

                        <a href="{{route('wish.index')}}" class="header-icon" title="wishlist"><i class="icon-wishlist-2"></i></a>

                        <div class="dropdown cart-dropdown">
							<a href="{{route('cart.index')}}" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
								<i class="minicart-icon"></i>
								<span class="cart-count badge-circle">{{(!empty($cart)) ? count($cart) : '0'}}</span>
							</a>


							<div class="cart-overlay"></div>

							<div class="dropdown-menu mobile-cart">
								<a href="#" title="Close (Esc)" class="btn-close">×</a>

								<div class="dropdownmenu-wrapper custom-scrollbar">
									<div class="dropdown-cart-header">Giỏ hàng</div>
									<!-- End .dropdown-cart-header -->
                                    @if(Auth::check() && !empty($cart) && count($cart) > 0)
                                        <div class="dropdown-cart-products">
                                        
                                            @foreach($cart as $val)
                                                <div class="product">
                                                    <div class="product-details">
                                                        <h4 class="product-title">
                                                            <a href="{{route('product', ['id' => $val->product_id])}}">{{$val->product_name}}</a>
                                                        </h4>
                                                        @if(!empty($val->sale_price))
                                                        <span class="cart-product-info">
                                                            <span class="cart-product-qty">{{$val->quantity}}</span>
                                                            × {{number_format((int) $val->sale_price, 0, ',', '.')}}đ
                                                        </span>
                                                        @else
                                                        <span class="cart-product-info">
                                                            <span class="cart-product-qty">{{$val->quantity}}</span>
                                                            × {{number_format((int) $val->normal_price, 0, ',', '.')}}đ
                                                        </span>
                                                        @endif
                                                    </div><!-- End .product-details -->

                                                    <figure class="product-image-container">
                                                        <a href="{{route('product', ['id' => $val->product_id])}}" class="product-image">
                                                            <img src="{{url('assets')}}/uploads/products/{{$val->avt_pro}}" alt="product"
                                                                width="80" height="80">
                                                        </a>

                                                        <a href="{{route('cart.delete', $val->id)}}" class="btn-remove" title="Remove Product"><span>×</span></a>
                                                    </figure>
                                                </div><!-- End .product -->
                                            @endforeach
                                    @else
                                        <p style="text-align: center">
                                            Giỏ hàng của bạn đang trống
                                        </p>
                                    @endif
									</div><!-- End .cart-product -->

									<div class="dropdown-cart-total">
										<span>Tổng tiền:</span>

										<span class="cart-total-price float-right">{{number_format($total, 0, ',' , '.')}}đ</span>
									</div><!-- End .dropdown-cart-total -->

									<div class="dropdown-cart-action">
										<a href="{{route('cart.index')}}" class="btn btn-gray btn-block view-cart">Xem giỏ hàng</a>
										<a href="{{route('order.checkout')}}" class="btn btn-dark btn-block">Thanh toán</a>
									</div><!-- End .dropdown-cart-total -->
								</div><!-- End .dropdownmenu-wrapper -->
							</div><!-- End .dropdown-menu -->
						</div><!-- End .dropdown -->

                    </div>
                    <!-- End .header-right -->
                </div>
                <!-- End .container -->
            </div>
            <!-- End .header-middle -->

            <div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
                <div class="container">
                    <nav class="main-nav w-100">
                        <ul class="menu">
                            <li>
                            <a href="{{route('home')}}">Trang chủ</a>
                            </li>

                            <li>
                                <a href="#">Danh mục</a>
                                <ul>
                                    @foreach($category as $cate)
                                        <li>
                                            <a href="{{ route('category-product', ['id' => $cate->id]) }}">{{ $cate->name }}</a>
                                            @foreach($cate_con as $val)
                                                @if($val->patent_id == $cate->id)
                                                    <ul>
                                                        @foreach($cate_con as $subcate)
                                                            @if($subcate->patent_id == $cate->id)
                                                                <li><a href="{{ route('category-product', ['id' => $subcate->id]) }}">{{ $subcate->name }}</a></li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            @endforeach
                                        </li>
                                    @endforeach
                                </ul>
                            </li>

                            <li>
                                <a href="{{route('product-list')}}">Sản phẩm</a>
                            </li>

                            <li>
                                <a href="{{route('wish.index')}}">Yêu thích</a>
                            </li>

                            <li>
                                <a href="{{route('cart.index')}}">Giỏ hàng</a>
                            </li>

                            {{-- <li>
                                <a href="#">Pages</a>
                                <ul>
                                    <li><a href="{{route('wish.index')}}">Yêu thích</a></li>
                                    <li><a href="{{route('cart.index')}}">Giỏ hàng</a></li>
                                    <!-- <li><a href="checkout.html">Checkout</a></li> -->
                                    <li><a href="{{route('profile.index')}}">Tài khoản</a></li>
                                    <li><a href="#">Thông tin</a></li>
                                    <li><a href="#">Tin tức</a>
                                        <ul>
                                            <li><a href="#">Blog</a></li>
                                            <li><a href="#">Blog Post</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Liên hệ</a></li>
                                </ul>
                            </li> --}}
                        </ul>
                    </nav>
                </div>
                <!-- End .container -->
            </div>
            <!-- End .header-bottom -->
        </header>