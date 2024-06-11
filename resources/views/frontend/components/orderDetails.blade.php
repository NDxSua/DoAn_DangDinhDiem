@extends('frontend.layouts.main')

@section('content')
    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="#">Đơn hàng</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Chi tiết đơn hàng
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>Chi tiết đơn hàng</h1>
            </div>
        </div>

        <div class="container">
            <div class="wishlist-title">
                <h2 class="p-2">Chi tiết đơn hàng số {{$order[0]->id}}</h2>
            </div>
            <div class="row">
                <table class="">
                    <tr>
                        <td style="font-weight: 600; min-width: 100px">Họ tên</td>
                        <td>: {{$order[0]->fullname}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600;">Địa chỉ giao hàng</td>
                        <td>: {{$order[0]->street_address}}, {{$order[0]->district}}, {{$order[0]->province}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600;">Số điện thoại</td>
                        <td>: {{$order[0]->phone}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600;">Tình trạng</td>
                        <td>: @if($order[0]->status == 0) <span style="color: red;">Đang xử lý</span>
                                @elseif($order[0]->status == 1) <span style="color: rgb(60, 71, 58);">Đang giao hàng</span>
                                @elseif($order[0]->status == 4) <span style="color: red;">Đơn hàng đã bị hủy</span>
                                @else	<span style="color: rgb(132, 151, 214);">Đã nhận hàng</span>
                                @endif  
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600;">Vận chuyển</td>
                        <td>: {{$order[0]->delivery_name}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600;">Thanh toán</td>
                        @if($order[0]->payment_method == 1)
                        <td>: <span style="color: rgb(134, 221, 34);">Thanh toán khi giao hàng</span>
                        @else
                        <td>: <span style="color: rgb(134, 221, 34);">Đã thanh toán qua MoMo</span>
                        @endif
                    </tr>
                    <tr>
                        <td style="font-weight: 600;">Ngày đặt hàng</td>
                        <td>: {{$order[0]->created_at}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 20px;"></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600;">Tổng tiền hàng</td>
                        <td>: {{number_format($SumPrice[0]->total_amount, 0, ',', '.')}} VND</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600;">Phí vận chuyển</td>
                        @if($order[0]->delivery_id == 1)
                            <td>: 20.000 VND</td>
                        @else
                            <td>: 40.000 VND</td>
                        @endif
                    </tr>
                    <tr>
                        <td style="font-weight: 600;">Tổng cộng</td>
                        <td>: {{number_format($order[0]->total, 0, ',', '.')}} VND</td>
                    </tr>
                </table>
            </div>
            <div class="wishlist-table-container">
                <table class="table table-wishlist mb-0">
                    <thead>
                        <tr>
                            <th class="thumbnail-col"></th>
                            <th class="product-col">Sản phẩm</th>
                            <th class="product-col">Màu sắc</th>
                            <th class="price-col">Số lượng</th>
                            <th class="price-col">Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(!empty($order_detail) && count($order_detail) > 0)
                        @foreach($order_detail as $val)                     
                        <tr class="product-row">
                            <td>
                                <figure class="product-image-container">
                                    <a href="{{route('product', ['id' => $val->product_id])}}" class="product-image">
                                        <img src="{{url('assets')}}/uploads/products/{{$val->avt_pro}}" alt="product">
                                    </a>
                                </figure>
                            </td>
                            <td>
                                <h5 class="product-title">
                                    <a href="{{route('product', ['id' => $val->product_id])}}">{{$val->product_name}}</a>
                                </h5>
                            </td>
                            <td>{{$val->color}}</td>
                            <td>
                                <span class="stock-status">{{$val->quantity}}</span>
                            </td>
                            <td class="price-box">{{number_format((int) $val->price, 0, ',', '.')}}đ</td>
                            {{-- <td class="action">
                                <form action="{{route('cart.add')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$val->product_id}}">
                                    <button type="submit" class="btn btn-primary">
                                        Thêm vào giỏ
                                    </button>
                                </form>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                @if($order[0]->status == 0)
                    <form method="post" id="formDeleteOrder" action="{{route('deleteOrder')}}">
                        @csrf
                        @method('Patch')
                        <input type="hidden" name="id" value="{{$order[0]->id}}" />
                        <button type="button" id="buttonDeleteOrder" class="btn btn-primary">Hủy đơn hàng</button>
                    </form>
                @elseif($order[0]->status == 1)
                    <form method="post" id="formSuccessOrder" action="{{route('successOrder')}}">
                        @csrf
                        @method('Patch')
                        <input type="hidden" name="id" value="{{$order[0]->id}}" />
                        <button type="button" id="buttonSuccessOrder" class="btn btn-primary">Xác nhận nhận hàng</button>
                    </form>
                @elseif($order[0]->status == 4)
                <h2>Đơn hàng đã bị hủy!</h2>
                @else
                    <h2>Đơn hàng đã được giao thành công!</h2>
                @endif
        @else
            <p>Không tìm thấy đơn hàng</p>
        @endif       
            </div><!-- End .cart-table-container -->
        </div><!-- End .container -->
    </main><!-- End .main -->
@endsection

@section('scripts')

<script>
    $(document).ready(function() {
      $('#buttonDeleteOrder').on('click', function() {
        $isCheck = confirm('Bạn có chắc chắn muốn hủy đơn hàng này không ?');
        if($isCheck) {
          $('#formDeleteOrder').submit();
        }
      })

      $('#buttonSuccessOrder').on('click', function() {
        $isCheck = true;
        if($isCheck) {
          $('#formSuccessOrder').submit();
        }
      })
    })
</script>

@endsection


