@extends('frontend.layouts.main')

@section('content')
    <main class="main main-test">
        <div class="container checkout-container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li>
                    <a href="{{route('cart.index')}}">Giỏ hàng</a>
                </li>
                <li class="active">
                    <a href="{{route('order.checkout')}}">Thanh toán</a>
                </li>
            </ul>

            {{-- <div class="login-form-container">
                <h4>Returning customer?
                    <button data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="btn btn-link btn-toggle">Login</button>
                </h4>

                <div id="collapseOne" class="collapse">
                    <div class="login-section feature-box">
                        <div class="feature-box-content">
                            <form action="#" id="login-form">
                                <p>
                                    If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing & Shipping section.
                                </p>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-0 pb-1">Username or email <span
                                                    class="required">*</span></label>
                                            <input type="email" class="form-control" required />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-0 pb-1">Password <span
                                                    class="required">*</span></label>
                                            <input type="password" class="form-control" required />
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn">LOGIN</button>

                                <div class="form-footer mb-1">
                                    <div class="custom-control custom-checkbox mb-0 mt-0">
                                        <input type="checkbox" class="custom-control-input" id="lost-password" />
                                        <label class="custom-control-label mb-0" for="lost-password">Remember
                                            me</label>
                                    </div>

                                    <a href="forgot-password.html" class="forget-password">Lost your password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="checkout-discount">
                <h4>Have a coupon?
                    <button data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne" class="btn btn-link btn-toggle">ENTER YOUR CODE</button>
                </h4>

                <div id="collapseTwo" class="collapse">
                    <div class="feature-box">
                        <div class="feature-box-content">
                            <p>If you have a coupon code, please apply it below.</p>

                            <form action="#">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm w-auto" placeholder="Coupon code" required="" />
                                    <div class="input-group-append">
                                        <button class="btn btn-sm mt-0" type="submit">
                                            Apply Coupon
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}
        <form action="{{url('/order/checkout')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-7">
                    <ul class="checkout-steps">
                        <li>
                            <h2 class="step-title mb-2">Thông tin giao hàng</h2>
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <div class="form-group">
                                    <label>Họ tên</label>
                                    <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}" />
                                </div>

                                <div class="form-group">
                                    <label>Số điện thoại <abbr class="required" title="required">*</abbr></label>
                                    <input type="tel" name="phone" class="form-control" value="{{Auth::user()->phone}}" required />
                                </div>

                                <div class="form-group">
                                    <label>Email
                                        <abbr class="required" title="required">*</abbr></label>
                                    <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}" required />
                                </div>
                                
                                <div class="form-group">
                                    <label>Tỉnh / Thành phố</label>
                                    <input type="text" name="province" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label>Quận / Huyện</label>
                                    <input type="text" name="district" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label>Tên đường / Số nhà</label>
                                    <input type="text" name="street_address" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label class="order-comments">Ghi chú đơn hàng</label>
                                    <textarea class="form-control" name="note" placeholder="Ghi chú đơn hàng của bạn"></textarea>
                                </div>
                        </li>
                    </ul>
                </div>
                <!-- End .col-lg-8 -->

                <div class="col-lg-5">
                    <div class="order-summary">
                        <h3>Đơn hàng của bạn</h3>

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
                                <tr class="order-shipping">
                                    <td class="text-left"  colspan="2"><h4>Vận chuyển</h4></td>
                                </tr>
                                <tr class="order-shipping">
                                    <td class="text-left">
                                        <div class="form-group form-group-custom-control">
                                            <div class="custom-control custom-radio d-flex">
                                                <input type="radio" class="custom-control-input" name="radio" required id="normal" value="normal"/>
                                                <label class="custom-control-label">Bình thường</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>20.000đ</td>
                                </tr>
                                <tr class="order-shipping">
                                    <td class="text-left">
                                        <div class="form-group form-group-custom-control mb-0">
                                            <div class="custom-control custom-radio d-flex mb-0">
                                                <input type="radio" name="radio" required class="custom-control-input" id="fast" value="fast">
                                                <label class="custom-control-label">Hỏa tốc</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>40.000đ</td>
                                </tr>
                                
                                

                                <tr class="order-total">
                                    <td>
                                        <h4>Tổng cộng</h4>
                                    </td>
                                    <td>
                                        <b class="total-price">{{number_format($total, 0, ',' , '.')}}đ</b>
                                    </td>
                                </tr>
                                <input type="hidden" name="total_price" value="{{$total}}">
                            </tfoot>
                        </table>

                        <div class="payment-methods">
                            <h4>Chọn phương thức thanh toán</h4>
                    
                            <div class="custom-control custom-radio d-flex mb-0">
                                <input class="custom-control-input" type="radio" required name="paymentMethod" value="cod">
                                <label class="custom-control-label" for="cod">
                                    Thanh toán khi nhận hàng
                                </label>
                            </div>
                    
                            <div class="custom-control custom-radio d-flex mb-0">
                                <input class="custom-control-input" type="radio" required name="paymentMethod" value="payUrl">
                                <label class="custom-control-label" for="payUrl">
                                    Thanh toán qua MoMo
                                </label>
                            </div>
                        </div>
                        <!-- Kết thúc lựa chọn phương thức thanh toán -->
                    
                        <!-- Nút thanh toán -->
                        <button type="submit" class="btn btn-primary btn-place-order mb-3">
                            <span class="btn-text">Thanh toán</span>
                        </button>

                        {{-- <button type="submit" name="cod" class="btn btn-outline-primary-2 btn-order btn-block mb-3">
                            <span class="btn-text">Thanh toán khi nhận hàng</span>
                        </button>

                        <button type="submit" name="payUrl" class="btn btn-outline-primary-2 btn-order btn-block mb-3">
                            <span class="btn-text">Thanh toán qua MoMo</span>
                        </button> --}}
                    </div>
                    <!-- End .cart-summary -->
                </div>
                <!-- End .col-lg-4 -->
            </div>
        </form>
            <!-- End .row -->
        </div>
        <!-- End .container -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Lấy ra các radio button và thẻ input
                var normalRadio = document.getElementById('normal');
                var fastRadio = document.getElementById('fast');
                var totalPriceElement = document.querySelector('.total-price');
                var hiddenInput = document.querySelector('input[name="total_price"]');
                var currentTotal = parseFloat(hiddenInput.value);
        
                // Lắng nghe sự kiện thay đổi khi người dùng chọn radio
                normalRadio.addEventListener('change', function () {
                    updateTotalPrice(20000);
                });
        
                fastRadio.addEventListener('change', function () {
                    updateTotalPrice(40000);
                });
        
                // Hàm cập nhật giá trị tổng tiền
                function updateTotalPrice(extraCost) {
                    // Tính tổng tiền mới
                    var newTotal = currentTotal + extraCost;
        
                    // Cập nhật giá trị tổng tiền hiển thị
                    totalPriceElement.innerText = newTotal.toLocaleString() + 'đ';
        
                    // Cập nhật giá trị trong input hidden
                    hiddenInput.value = newTotal;
        
                    // Cập nhật giá trị hiện tại dựa trên số tiền muốn thêm vào
                    currentTotal = newTotal - extraCost;
                }
            });
        </script>
    </main>
    
    <!-- End .main -->

@endsection





