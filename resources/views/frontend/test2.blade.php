<form action="{{url('/order/checkout')}}" method="POST">
    @csrf
    <div class="row">

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
                            <td class="text-left" colspan="2">
                                <h4 class="m-b-sm">Vận chuyển</h4>

                                <div class="form-group form-group-custom-control">
                                    <div class="custom-control custom-radio d-flex">
                                        <input type="radio" class="custom-control-input" name="radio" id="normal" value="normal"/>
                                        <label class="custom-control-label">Bình thường</label>
                                    </div>
                                    <!-- End .custom-checkbox -->
                                </div>
                                <!-- End .form-group -->

                                <div class="form-group form-group-custom-control mb-0">
                                    <div class="custom-control custom-radio d-flex mb-0">
                                        <input type="radio" name="radio" class="custom-control-input" id="fast" value="fast">
                                        <label class="custom-control-label">Hỏa tốc</label>
                                    </div>
                                    <!-- End .custom-checkbox -->
                                </div>
                                <!-- End .form-group -->
                            </td>

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



                <button type="submit" name="cod" class="btn btn-primary btn-place-order mb-3">
                    <span class="btn-text">Thanh toán khi nhận hàng</span>
                </button>

                <button type="submit" name="payUrl" class="btn btn-primary btn-place-order mb-3">
                    <span class="btn-text">Thanh toán qua MoMo</span>
                </button>
            </div>
            <!-- End .cart-summary -->
        </div>
        <!-- End .col-lg-4 -->
    </div>
</form>