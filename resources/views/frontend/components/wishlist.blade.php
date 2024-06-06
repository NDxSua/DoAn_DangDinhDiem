@extends('frontend.layouts.main')

@section('content')
    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="demo4.html">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Yêu thích
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>Yêu thích</h1>
            </div>
        </div>

        <div class="container">
            <div class="wishlist-title">
                <h2 class="p-2">Sản phẩm yêu thích của tôi</h2>
            </div>
            <div class="wishlist-table-container">
                <table class="table table-wishlist mb-0">
                    <thead>
                        <tr>
                            <th class="thumbnail-col"></th>
                            <th class="product-col">Sản phẩm</th>
                            <th class="price-col">Giá</th>
                            <th class="status-col">Tình trạng</th>
                            <th class="action-col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(!empty($wish) && count($wish) > 0)
                        @foreach($wish as $val)                     
                        <tr class="product-row">
                            <td>
                                <figure class="product-image-container">
                                    <a href="{{route('product', ['id' => $val->product_id])}}" class="product-image">
                                        <img src="{{url('assets')}}/uploads/products/{{$val->avt_pro}}" alt="product">
                                    </a>

                                    <a href="{{route('wish.add', $val->product_id)}}" class="btn-remove icon-cancel" title="Remove Product"></a>
                                </figure>
                            </td>
                            <td>
                                <h5 class="product-title">
                                    <a href="{{route('product', ['id' => $val->product_id])}}">{{$val->product_name}}</a>
                                </h5>
                            </td>
                            @if(!empty($val->sale_price))
                                <td class="price-box">{{number_format((int) $val->sale_price, 0, ',', '.')}}đ</td>
                            @else
                                <td class="price-box">{{number_format((int) $val->normal_price, 0, ',', '.')}}đ</td>
                            @endif
                            <td>
                                <span class="stock-status">Còn hàng</span>
                            </td>
                            <td class="action">
                                <form action="{{route('cart.add')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$val->product_id}}">
                                    <button type="submit" class="btn btn-primary">
                                        Thêm vào giỏ
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td class="text-center p-0" colspan="5">
                            <p class="mb-5 mt-5">
                                Chưa có sản phẩm nào
                            </p>
                            <hr class="mt-0 mb-3 pb-2" />
                            <a href="{{route('product-list')}}" class="btn btn-dark mb-3">Đến sản phẩm</a>
                        </td>
                    </tr>

                    @endif
                    </tbody>
                </table>
            </div><!-- End .cart-table-container -->
        </div><!-- End .container -->
    </main><!-- End .main -->
@endsection

