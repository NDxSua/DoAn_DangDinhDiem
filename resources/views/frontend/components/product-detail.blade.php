@extends('frontend.layouts.main')


@section('content')

            <div class="container">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('product-list')}}">Sản phẩm</a></li>
                        <li class="breadcrumb-item"><a href="{{route('product', ['id' => $product->id])}}">Chi tiết sản phẩm</a></li>
                    </ol>
                </nav>

                <div class="product-single-container product-single-default">
                    <div class="cart-message d-none">
                        <strong class="single-cart-notice">“{{$product->name}}”</strong>
                        <span>đã được thêm vào giỏ hàng.</span>
                    </div>

                    <div class="row">
                        <div class="col-lg-5 col-md-6 product-single-gallery">
                            <div class="product-slider-container">
                                
                                <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                    <div class="product-item">
                                        <img class="product-single-image" src="{{url('assets')}}/uploads/products/{{$product->avatar_pro}}" data-zoom-image="{{url('assets')}}/uploads/{{$product->avatar_pro}}" width="468" height="468" alt="product" />
                                    </div>
                                    @foreach($images as $img)
                                    <div class="owl-dot">
                                        <img src="{{url('assets')}}/uploads/products/{{$img->url}}" width="110" height="110" alt="product-thumbnail" />
                                    </div>
                                    @endforeach
                                </div>
                                <!-- End .product-single-carousel -->
                                <span class="prod-full-screen">
									<i class="icon-plus"></i>
								</span>
                            </div>

                            <div class="prod-thumbnail owl-dots">
                                <div class="owl-dot">
                                    <img src="{{url('assets')}}/uploads/products/{{$product->avatar_pro}}" width="110" height="110" alt="product-thumbnail" />
                                </div>
                                @foreach($images as $img)
                                <div class="owl-dot">
                                    <img src="{{url('assets')}}/uploads/products/{{$img->url}}" width="110" height="110" alt="product-thumbnail" />
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End .product-single-gallery -->
                  
                        <div class="col-lg-7 col-md-6 product-single-details">
                            <h1 class="product-title">{{$product->name}}</h1>
                                <div class="product-action">
                                    @if($product->wished)
                                        <a href="{{route('wish.add', $product->id)}}" class="btn-icon-love" title="Bỏ thích"><i
                                            class="fas fa-heart"></i></a>
                                    @else
                                        <a href="{{route('wish.add', $product->id)}}" class="btn-icon-love" title="Yêu thích"><i
                                            class="far fa-heart"></i></a>
                                    @endif
                                </div>
                            {{-- @if($product->wished)
                            <a href="{{route('wish.add', $product->id)}}" class="btn-icon-love" title="Bỏ thích"><i
                                class="fas fa-heart"></i></a>
                            @else
                                <a href="{{route('wish.add', $product->id)}}" class="btn-icon-love" title="Yêu thích"><i
                                    class="far fa-heart"></i></a>
                            @endif --}}

                            <!-- <div class="product-nav">
                                <div class="product-prev">
                                    <a href="#">
                                        <span class="product-link"></span>

                                        <span class="product-popup">
											<span class="box-content">
												<img width="150" height="150"
													src="assets/images/products/product-3.jpg"
													style="padding-top: 0px;">

												<span>Circled Ultimate 3D Speaker</span>
                                        </span>
                                        </span>
                                    </a>
                                </div>

                                <div class="product-next">
                                    <a href="#">
                                        <span class="product-link"></span>

                                        <span class="product-popup">
											<span class="box-content">
												<img alt="product" width="150" height="150"
													src="assets/images/products/product-4.jpg"
													style="padding-top: 0px;">

												<span>Blue Backpack for the Young</span>
                                        </span>
                                        </span>
                                    </a>
                                </div>
                            </div> -->

                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:60%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->

                                <!-- <a href="#" class="rating-link">( 6 Reviews )</a> -->

                            </div>
                            <!-- End .ratings-container -->



                            <hr class="short-divider">
                            @if(!empty($product->promotional_price))
                            <div class="price-box">
                                <span class="old-price">{{number_format((int) $product->price, 0, ',', '.')}}đ</span>
                                <span class="new-price">{{number_format((int) $product->promotional_price, 0, ',', '.')}}đ</span>
                            </div>
                            <!-- End .price-box -->
                            @else
                            <div class="price-box">
                                <span class="new-price">{{number_format((int) $product->price, 0, ',', '.')}}đ</span>
                            </div>
                            @endif
                            <div class="product-desc">
                                <p>{{$product->description}}</p>
                            </div>
                            <!-- End .product-desc -->

                            <ul class="single-info-list">

                                Danh mục: <strong>@foreach($cate as $val)
                                    @if($product->category_id == $val->id)
                                    <a href="{{route('category-product', $val->id)}}" class="product-category">{{$val->name}}</a>
                                    </strong>@endif
                                    @endforeach
                            </ul>

                            <ul class="single-info-list">
                                Màu sắc: <strong>{{$product->color}}</strong>
                            </ul>

                            <ul class="single-info-list">
                                Số lượng còn: <strong>{{$product->quantity}}</strong>
                            </ul>

                            <div class="product-action">
                                <form action="{{route('cart.add')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <div class="product-single-qty">
                                        <input class="horizontal-quantity form-control" name="quantity" type="text">
                                    </div>
                                    <!-- End .product-single-qty -->
                                    <button type="submit" class="btn btn-dark mr-2">Thêm vào giỏ</button>
                                </form>
                            </div>
                            <!-- End .product-action -->

                            <hr class="divider mb-0 mt-0">

                            <div class="product-single-share mb-3">
                                <label class="sr-only">Share:</label>

                                <!-- <div class="social-icons mr-2">
                                    <a href="#" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
                                    <a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                                    <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank" title="Linkedin"></a>
                                    <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank" title="Google +"></a>
                                    <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank" title="Mail"></a>
                                </div> -->
                                <!-- End .social-icons -->
                            </div>
                            <!-- End .product single-share -->
                        </div>
                        <!-- End .product-single-details -->
                    </div>
                    <!-- End .row -->
                </div>
                <!-- End .product-single-container -->

                <div class="product-single-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Mô tả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content" role="tab" aria-controls="product-tags-content" aria-selected="false">Thông số kỹ thuật</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">Đánh giá ({{count($pro_cmt)}})</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                            <div class="product-desc-content">
                                <p>{!! nl2br(e($product->description)) !!}</p>
                            </div>
                            
                        </div>

                        <div class="tab-pane fade" id="product-tags-content" role="tabpanel" aria-labelledby="product-tab-tags">
                            <table class="table table-striped mt-2">
                                <tbody>
                                    @foreach($pro_att as $att)
                                    <tr>
                                        <th>{{$att->att_name}}</th>
                                        <td>{{$att->att_value}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End .tab-pane -->
                        <div class="tab-pane fade" id="product-reviews-content" role="tabpanel" aria-labelledby="product-tab-reviews">
                            <div class="product-reviews-content">
                                <h3 class="reviews-title"></h3>

                                <div class="comment-list">
                                    @foreach($pro_cmt as $cmt)
                                        <div class="comments">
                                            <figure class="img-thumbnail">
                                                <img src="{{url('assets')}}/images/clients/client-1.jpg" alt="author" width="80" height="80">
                                            </figure>

                                            <div class="comment-block">
                                                <div class="comment-header">
                                                    <div class="comment-arrow"></div>

                                                    {{-- <div class="ratings-container float-sm-right">
                                                        <div class="product-ratings">
                                                            <span class="ratings" style="width:60%"></span>
                                        
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
    
                                                    </div> --}}

                                                    <span class="comment-by">
                                                        <strong>{{$cmt->user_name}}</strong> – <span class="comment-date">{{$cmt->date}}</span>
                                                    </span>
                                                </div>

                                                <div class="comment-content">
                                                    <p>{{$cmt->content}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                    @endforeach
                                </div>

                                <div class="add-product-review">
                                    <h3 class="review-title">Thêm nhận xét</h3>

                                    <form action="{{route('add_comment')}}" class="comment-form m-0" method="POST">
                                        @csrf
                                        {{-- <div class="rating-form">
                                            <label for="rating">Your rating <span class="required">*</span></label>
                                            <span class="rating-stars">
												<a class="star-1" href="#">1</a>
												<a class="star-2" href="#">2</a>
												<a class="star-3" href="#">3</a>
												<a class="star-4" href="#">4</a>
												<a class="star-5" href="#">5</a>
											</span>

                                            <select name="rating" id="rating" required="" style="display: none;">
												<option value="">Rate…</option>
												<option value="5">Perfect</option>
												<option value="4">Good</option>
												<option value="3">Average</option>
												<option value="2">Not that bad</option>
												<option value="1">Very poor</option>
											</select>
                                        </div> --}}

                                        <div class="form-group">
                                            <label>Đánh giá của bạn <span class="required">*</span></label>
                                            <textarea cols="5" rows="6" name="content" class="form-control form-control-sm"></textarea>
                                        </div>
                                        <!-- End .form-group -->
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <button type="submit" class="btn btn-primary" value="Submit">Đăng</button>
                                    </form>
                                </div>
                                <!-- End .add-product-review -->
                            </div>
                            <!-- End .product-reviews-content -->
                        </div>
                        <!-- End .tab-pane -->

                        <!-- End .tab-pane -->


                        <!-- End .tab-pane -->
                    </div>
                    <!-- End .tab-content -->
                </div>
                <!-- End .product-single-tabs -->


                <!-- End .products-section -->

                <hr class="mt-0 m-b-5" />


                <!-- End .row -->
            </div>
            <!-- End .container -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var commentDates = document.querySelectorAll(".comment-date");
            commentDates.forEach(function(commentDate) {
                var date = moment(commentDate.innerText);
                var now = moment();
                var diffInMinutes = now.diff(date, 'minutes');
                var diffInSeconds = now.diff(date, 'seconds');
                var diffInHours = now.diff(date, 'hours');
                var diffInDays = now.diff(date, 'days');
                var diffInWeeks = now.diff(date, 'weeks');
    
                if (diffInMinutes < 1) {
                    commentDate.innerText = diffInSeconds + " giây trước";
                }
                 else if (diffInMinutes < 60) {
                    commentDate.innerText = diffInMinutes + " phút trước";
                } else if (diffInHours < 24) {
                    commentDate.innerText = diffInHours + " giờ trước";
                }
                 else if (diffInDays < 8) {
                    commentDate.innerText = diffInDays + " ngày trước";
                } else if (diffInWeeks < 5) {
                    commentDate.innerText = diffInWeeks + " tuần trước";
                } else {
                    commentDate.innerText = moment(date).format("DD/MM/YYYY");
                }
            });
        });
    </script>


        <!-- End .main -->
@endsection



