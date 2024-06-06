@extends('frontend.layouts.main')

@section('content')

    <main class="main">
        <div class="container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li class="active">
                    <a href="{{route('cart.index')}}">Giỏ hàng</a>
                </li>
                <li>
                    <a href="{{route('order.checkout')}}">Thanh toán</a>
                </li>
            </ul>

            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-table-container">
                        <table class="table table-cart">
                            <thead>
                                <tr>
                                    <th class="thumbnail-col"></th>
                                    <th class="product-col">Sản phẩm</th>
                                    <th class="product-col">Màu sắc</th>
                                    <th class="price-col">Giá bán</th>
                                    <th class="qty-col">Số lượng</th>
                                    <th class="text-right">Thành tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($cart) && count($cart) > 0)
                                    @foreach ($cart as $val)
                                    <form action="{{route('cart.update')}}" method="POST">
                                        @csrf
                                        <tr class="product-row">
                                            <input type="hidden" name="id_cart" value="{{$val->id}}">
                                            <td>
                                                <figure class="product-image-container">
                                                    <a href="{{route('product', ['id' => $val->product_id])}}" class="product-image">
                                                        <img src="{{url('assets')}}/uploads/products/{{$val->avt_pro}}" alt="product">
                                                    </a>

                                                    <a href="{{route('cart.delete', $val->id)}}" class="btn-remove icon-cancel" title="Remove Product"></a>
                                                </figure>
                                            </td>
                                            <td class="product-col">
                                                <h5 class="product-title">
                                                    <a href="{{route('product', ['id' => $val->product_id])}}">{{$val->product_name}}</a>
                                                </h5>
                                            </td>
                                            <td>{{$val->color}}</td>
                                            <td>
                                                @if($val->sale_price != null)
                                                {{number_format((int) $val->sale_price, 0, ',', '.')}}đ
                                                @else
                                                {{number_format((int) $val->normal_price, 0, ',', '.')}}đ
                                                @endif
                                            </td>
                                            <td>
                                                <div class="product-single-qty">
                                                    <input class="horizontal-quantity form-control" id="quantity" value="{{$val->quantity}}" type="text">               
                                                </div><!-- End .product-single-qty -->
                                            </td>
                                            <input type="hidden" name="quantity" value="{{$val->quantity}}">
                                            <td class="text-right">
                                                <span class="subtotal-price" id="money">{{number_format((int) $val->money, 0, ',', '.')}}đ</span>
                                            </td>
                                            <input type="hidden" name="money" value="{{$val->money}}">
                                            <td><button type="submit" class="btn btn-shop btn-update-cart">Cập nhật</button></td>
                                        </tr>
                                    </form>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center p-0" colspan="5">
                                            <p class="mb-5 mt-5">
                                                Chưa có sản phẩm nào
                                            </p>
                                            {{-- <hr class="mt-0 mb-3 pb-2" />
                                            <a href="{{route('product-list')}}" class="btn btn-dark mb-3">Đến sản phẩm</a> --}}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div><!-- End .cart-table-container -->
                </div><!-- End .col-lg-8 -->

                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h3>CART TOTALS</h3>

                        <table class="table table-mini-cart mb-2">
                            <thead>
                                <tr>
                                    <th colspan="2">Sản phẩm</th>
                                </tr>
                            </thead>
                           
                            <tbody>
                                @foreach($cart as $val)
                                <tr>
                                    <td class="product-col">
                                        <h3 class="product-title">
                                            {{$val->product_name}} ×
                                            <span class="product-qty">{{$val->quantity}}</span>
                                        </h3>
                                    </td>

                                    <td class="price-col">
                                        <span>{{number_format($val->money, 0, ',' , '.')}}đ</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <td>
                                        <h4>Tổng tiền</h4>
                                    </td>

                                    <td class="price-col">
                                        <span>{{number_format($total, 0, ',' , '.')}}đ</span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="checkout-methods">
                            <a href="{{route('order.checkout')}}" class="btn btn-block btn-primary">Thanh toán
                                <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div><!-- End .cart-summary -->
                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-6"></div><!-- margin -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var quantityInputs = document.querySelectorAll('.horizontal-quantity');

        quantityInputs.forEach(function (input) {
            input.addEventListener('change', function () {
                // Lấy giá trị mới của số lượng
                var newQuantity = parseInt(input.value);

                // Tìm phần tử chứa giá trị money và quantity ban đầu
                var row = input.closest('.product-row');
                var moneyElement = row.querySelector('.subtotal-price');
                var quantityHiddenInput = row.querySelector('input[name="quantity"]');
                var moneyHiddenInput = row.querySelector('input[name="money"]');
                var initialQuantity = parseInt(quantityHiddenInput.value);
                var initialMoney = parseInt(moneyHiddenInput.value);

                // Tính toán giá trị mới của money
                var newMoney = (initialMoney / initialQuantity) * newQuantity;

                // Hiển thị giá trị mới của money
                moneyElement.textContent = newMoney.toLocaleString() + 'đ';

                // Cập nhật giá trị của quantity và money trong input hidden
                quantityHiddenInput.value = newQuantity;
                moneyHiddenInput.value = newMoney;
            });
        });
    });
</script>
    </main><!-- End .main -->
@endsection




