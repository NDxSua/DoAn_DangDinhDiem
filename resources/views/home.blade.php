@extends('frontend.layouts.main')

@section('content')

<!-- End .info-boxes-slider -->
            @include('frontend.layouts.banner')

            <div class="container">

            <h2 class="section-title categories-section-title heading-border border-0 ls-0 appear-animate" data-animation-delay="100" data-animation-name="fadeInUpShorter">Danh mục
            </h2>
                
                    <div class="categories-slider owl-carousel owl-theme show-nav-hover nav-outer">
                        @foreach($category as $cate)
                        <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                            <a href="{{route('category-product', ['id' => $cate->id])}}">
                                <figure>
                                    <img src="{{url('assets')}}/uploads/categories/{{$cate->logo_cate}}" alt="category" width="358" height="358" />
                                </figure>
                                <div class="category-content">
                                    <h3>{{$cate->name}}</h3>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                <!-- End .info-boxes-slider -->
            </div>

            <br>
            <br>

            <div data-owl-options="{
				'loop': false
			}">
                <div>
                    <img class="slide-bg" src="{{url('assets')}}/uploads/banners/bannerha.jpg" alt="slider image">
                </div>
                <!-- <div class="home-slide home-slide1 banner">
                    <img class="slide-bg" src="{{url('assets')}}/uploads/banners/banner3.png" width="1903" height="499" alt="slider image">
                </div> -->
            </div>
            <section class="featured-products-section">
                <div class="container">
                    <h2 class="section-title heading-border ls-20 border-0">Sản phẩm nổi bật</h2>

                    <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center" data-owl-options="{
						'dots': false,
						'nav': true
					}">
                        @foreach($product as $pro)
                        <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                            <figure>
                                <a href="{{route('product', ['id' => $pro->id])}}">
                                <img src="{{url('assets')}}/uploads/products/{{$pro->avatar_pro}}" width="280" height="280" alt="product">
                                </a>
                            </figure>
                            <div class="product-details">
                                <div class="category-list">
                                    <a href="{{route('category-product', ['id' => $pro->category_id])}}" class="product-category">{{$pro->cate_name}}</a>
                                </div>
                                <h3 class="product-title">
                                    <a href="{{route('product', ['id' => $pro->id])}}">{{$pro->name}}</a>
                                </h3>
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:80%"></span>
                                        <!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <!-- End .product-ratings -->
                                </div>
                                <!-- End .product-container -->
                                @if(!empty($pro->promotional_price))
                                <div class="price-box">
                                    <span class="old-price">{{number_format((int) $pro->price, 0, ',', '.')}}đ</span>
                                    <span class="new-price">{{number_format((int) $pro->promotional_price, 0, ',', '.')}}đ</span>
                                </div>
                                <!-- End .price-box -->
                                @else
                                <div class="price-box">
                                    <span class="new-price">{{number_format((int) $pro->price, 0, ',', '.')}}đ</span>
                                </div>
                                @endif
                                <!-- End .price-box -->
                                <div class="product-action">
                                    @if($pro->wished)
                                        <a href="{{route('wish.add', $pro->id)}}" class="btn-icon-love" title="Bỏ thích"><i
                                            class="fas fa-heart"></i></a>
                                    @else
                                        <a href="{{route('wish.add', $pro->id)}}" class="btn-icon-love" title="Yêu thích"><i
                                            class="far fa-heart"></i></a>
                                    @endif

                                    <form action="{{route('cart.add')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$pro->id}}">
                                        <button type="submit" class="btn-icon btn-add-cart"><i
                                            class="fa fa-arrow-right"></i><span>Thêm vào giỏ</span></button>
                                    </form>
                                    <!-- <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
											class="fas fa-external-link-alt"></i></a> -->
                                </div>
                            </div>
                            <!-- End .product-details -->
                        </div>
                        @endforeach
                    </div>
                    <!-- End .featured-proucts -->
                </div>
            </section>
            <!-- End .feature-boxes-container -->

            <section class="blog-section pb-0">
                <div class="container">

                    <h2 class="section-title heading-border border-0 appear-animate" data-animation-name="fadeInUp">
                        Tin tức</h2>

                    <div class="owl-carousel owl-theme appear-animate" data-animation-name="fadeIn" data-owl-options="{
						'loop': false,
						'margin': 20,
						'autoHeight': true,
						'autoplay': false,
						'dots': false,
						'items': 2,
						'responsive': {
							'0': {
								'items': 1
							},
							'480': {
								'items': 2
							},
							'576': {
								'items': 3
							},
							'768': {
								'items': 4
							}
						}
					}">
                        <!-- <article class="post">
                            <div class="post-media">
                                <a href="single.html">
                                    <img src="assets/images/blog/home/post-1.jpg" alt="Post" width="225" height="280">
                                </a>
                                <div class="post-date">
                                    <span class="day">26</span>
                                    <span class="month">Feb</span>
                                </div>
                            </div>


                            <div class="post-body">
                                <h2 class="post-title">
                                    <a href="single.html">Top New Collection</a>
                                </h2>
                                <div class="post-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras non placerat mi. Etiam non tellus sem. Aenean...</p>
                                </div>

                                <a href="single.html" class="post-comment">0 Comments</a>
                            </div>
  
                        </article> -->

                        <!-- End .post -->
                    </div>

                    <hr class="mt-0 m-b-5">

                    <hr class="mt-4 m-b-5">

                    <!-- End .row -->
                </div>
            </section>
@endsection