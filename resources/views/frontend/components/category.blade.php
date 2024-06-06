@extends('frontend.layouts.main')

@section('content')




        <!-- End .top-notice -->


        <!-- End .header -->


            <div class="page-header">
				<div class="container d-flex flex-column align-items-center">
					<nav aria-label="breadcrumb" class="breadcrumb-nav">
						<div class="container">
							<ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{route('product-list')}}">Sản phẩm</a></li>
							</ol>
						</div>
					</nav>

					<h1>Sản phẩm</h1>
				</div>
			</div>

            <div class="container shop-off-canvas">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('product-list')}}">Sản phẩm</a></li>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col-lg-12">
                        <nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
                            <div class="toolbox-left">
                                <a href="#" class="sidebar-toggle d-inline-flex"><svg data-name="Layer 3" id="Layer_3"
                                        viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                        <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                                        <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                                        <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                                        <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                                        <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                                        <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                                        <path
                                            d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"
                                            class="cls-2"></path>
                                        <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                                        <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                                        <path
                                            d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"
                                            class="cls-2"></path>
                                    </svg>
                                    <span>Lọc</span>
                                </a>
                            </div>
                            <!-- End .toolbox-left -->

                            <div class="toolbox-right">
                                <div class="toolbox-item toolbox-sort ml-lg-auto">
                                    <label>Lọc theo:</label>

                                    <div class="select-custom">
                                        <select name="orderby" class="form-control">
                                            <option value="menu_order" selected="selected">Mặc định</option>
                                            <option value="price">Giá: Thấp đến cao</option>
                                            <option value="price-desc">Giá: Cao đến thấp</option>
                                        </select>
                                    </div>
                                    <!-- End .select-custom -->
                                </div>
                                <!-- End .toolbox-item -->


                                <!-- End .toolbox-item -->

                                <!-- End .layout-modes -->
                            </div>
                            <!-- End .toolbox-right -->
                        </nav>

                        <div class="row">
                        @if(!empty($product) && count($product) > 0)
                            @foreach($product as $pro)
                            <div class="col-6 col-sm-4 col-md-3">
                                <div class="product-default">
                                    <figure>
                                        <a href="{{route('product', ['id' => $pro->id])}}">
                                            <img src="{{url('assets')}}//uploads/products/{{$pro->avatar_pro}}" width="280" height="280" alt="product" />
                                        </a>

                                        {{-- <div class="label-group">
                                            <div class="product-label label-hot">HOT</div>
                                            <div class="product-label label-sale">-20%</div>
                                        </div> --}}
                                    </figure>

                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <div class="category-list">
                                                <a href="{{route('category-product', ['id' => $pro->category_id])}}" class="product-category">{{$pro->cate_name}}</a>
                                            </div>
                                        </div>

                                        <h3 class="product-title"> <a href="{{route('product', ['id' => $pro->id])}}">{{$pro->name}}</a> </h3>

                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:100%"></span>
                                                <!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <!-- End .product-ratings -->
                                        </div>
                                        <!-- End .product-container -->

                                        @if(!empty($pro->promotional_price))
                                        <div class="price-box">
                                            <span class="old-price">{{number_format((int) $pro->price, 0, ',', '.')}}đ</span>
                                            <span class="product-price">{{number_format((int) $pro->promotional_price, 0, ',', '.')}}đ</span>
                                        </div>
                                        <!-- End .price-box -->
                                        @else
                                        <div class="price-box">
                                            <span class="product-price">{{number_format((int) $pro->price, 0, ',', '.')}}đ</span>
                                        </div>
                                        @endif

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

                                        </div>
                                    </div>
                                    <!-- End .product-details -->
                                </div>
                            </div>
                            <!-- End .col-sm-4 -->
                            @endforeach
                        @else
                            <p>Không tìm thấy sản phẩm nào</p>
                        @endif
                        </div>
                        {{$product->appends(request()->all())->links()}}
                        <!-- End .row -->

                    </div>
                    <!-- End. col-lg-9 -->

                    <div class="sidebar-overlay"></div>
                    <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar custom-scrollbar position-fixed ">
                        <div class="sidebar-wrapper position-static">
                            <div class="widget">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true" aria-controls="widget-body-2">Danh mục</a>
                                </h3>

                                <div class="collapse show" id="widget-body-2">
                                    <div class="widget-body">
                                        <ul class="cat-list">
                                            @foreach($category as $cate)
                                            <li>
                                                <a href="#widget-category-1" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="widget-category-{{$cate->id}}">
                                                    {{$cate->name}}
                                                    <span class="toggle"></span>
                                                </a>
                                                @foreach($cate_con as $val)
                                                <div class="collapse show" id="widget-category-1">
                                                    <ul class="cat-sublist">
                                                        <li>
                                                            <a href="{{route('category-product', ['id' => $val->id])}}">
                                                                @if($val->patent_id == $cate->id)
                                                                    {{$val->name}}
                                                                @endif
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @endforeach
                                            </li>

                                        @endforeach
                                        </ul>
                                    </div>
                                    <!-- End .widget-body -->
                                </div>
                                <!-- End .collapse -->
                            </div>
                            <!-- End .widget -->
<!-- 
                            <div class="widget">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true" aria-controls="widget-body-3">Giá bán</a>
                                </h3>

                                <div class="collapse show" id="widget-body-3">
                                    <div class="widget-body pb-0">
                                        <form action="#">
                                            <div class="price-slider-wrapper">
                                                <div id="price-slider"></div>
        
                                            </div>


                                            <div class="filter-price-action d-flex align-items-center justify-content-between flex-wrap">
                                                <div class="filter-price-text">
                                                    Giá bán:
                                                    <span id="filter-price-range"></span>
                                                </div>
                  

                                                <button type="submit" class="btn btn-primary">Lọc</button>
                                            </div>
                        
                                        </form>
                                    </div>
                           
                                </div>
                     
                            </div> -->
                       


                            <!-- End .widget -->

                            <!-- End .widget -->


                            <!-- End .widget -->


                            <!-- End .widget -->
                        </div>
                        <!-- End .sidebar-wrapper -->
                    </aside>
                    <!-- End .col-lg-3 -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .container -->

            <div class="mb-3"></div>
            <!-- margin -->

        <!-- End .main -->

@endsection
        <!-- End .footer -->

    <!-- End .page-wrapper -->





