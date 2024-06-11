@extends('frontend.layouts.main')

@section('content')
    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Tài khoản
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>Tài khoản</h1>
            </div>
        </div>

        <div class="container account-container custom-account-container">
            <div class="row">
                <div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0">
                    <h2 class="text-uppercase">Tài khoản</h2>
                    <ul class="nav nav-tabs list flex-column mb-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard"
                                role="tab" aria-controls="dashboard" aria-selected="true">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab"
                                aria-controls="order" aria-selected="true">Đơn hàng</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="download-tab" data-toggle="tab" href="#change_pass" role="tab"
                                aria-controls="download" aria-selected="false">Đổi mật khẩu</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('cart.index')}}">Giỏ hàng</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
                                aria-controls="edit" aria-selected="false">Thông tin cá nhân</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('wish.index')}}">Sản phẩm yêu thích</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('logout')}}">Đâng xuất</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9 order-lg-last order-1 tab-content">
                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                        <div class="dashboard-content">
                            <p>
                                Xin chào, <strong class="text-dark">{{Auth::user()->name}}</strong>
                            </p>

                            <p>
                                Tại đây, bạn có thể theo dõi
                                <a class="btn btn-link link-to-tab" href="#order">tình trạng đơn hàng</a>,
                                quản lý
                                <a class="btn btn-link link-to-tab" href="#edit">thông tin cá nhân</a> cũng như
                                <a class="btn btn-link link-to-tab" href="#change_pass">thay đổi mật khẩu tài khoản</a>,...
                            </p>

                            <div class="mb-4"></div>

                            <div class="row row-lg">
                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="#order" class="link-to-tab"><i
                                                class="sicon-social-dropbox"></i></a>
                                        <div class="feature-box-content">
                                            <h3>Đơn hàng</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="#change_pass" class="link-to-tab"><i
                                                class="sicon-key"></i></a>
                                        <div class=" feature-box-content">
                                            <h3>Đổi mật khẩu</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="{{route('cart.index')}}" class="link-to-tab"><i
                                                class="sicon-handbag"></i></a>
                                        <div class="feature-box-content">
                                            <h3>Giỏ hàng</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="#edit" class="link-to-tab"><i class="icon-user-2"></i></a>
                                        <div class="feature-box-content p-0">
                                            <h3>Thông tin cá nhân</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="{{route('wish.index')}}"><i class="sicon-heart"></i></a>
                                        <div class="feature-box-content">
                                            <h3>Sản phẩm yêu thích</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="{{route('logout')}}"><i class="sicon-logout"></i></a>
                                        <div class="feature-box-content">
                                            <h3>Đăng xuất</h3>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End .row -->
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="order" role="tabpanel">
                        <div class="order-content">
                            <h3 class="account-sub-title d-none d-md-block">
                                <i class="sicon-social-dropbox align-middle mr-3"></i>Đơn hàng</h3>
                            <div class="order-table-container text-center">
                                <table class="table table-order text-left">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th class="order-action">Họ tên</th>
                                            <th class="order-action">Vận chuyển</th>
                                            <th class="order-action">Tình trạng</th>
                                            <th class="order-action">Ngày đặt</th>
                                            <th class="order-action">Tổng tiền</th>
                                            <th class="order-action">Thanh toán</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    @php
                                        $stt = 0;
                                    @endphp
                                    @if(!empty($order) && count($order) > 0)
                                    <tbody>
                                        @foreach($order as $val)
                                        @php
                                            $stt++;
                                        @endphp
                                        <tr>
                                            <td>{{$stt}}</td>
                                            <td>{{$val->fullname}}</td>
                                            <td>{{$val->delivery_name}}</td>
                                            <td>
                                                @php
                                                    if ($val->status == 0) {
                                                        echo 'Đang xử lý';
                                                    } elseif ($val->status == 1) {
                                                        echo 'Đang giao hàng';
                                                    } elseif ($val->status == 4) {
                                                        echo 'Đơn hàng đã bị hủy';
                                                    } else {
                                                        echo 'Đã nhận hàng';
                                                    }
                                                @endphp
                                            </td>
                                            <td>{{$val->created_at}}</td>
                                            <td>{{number_format($val->total, 0, ',' , '.')}}đ</td>
                                            @if($val->payment_status == 0)
                                            <td>Thanh toán khi giao hàng</td>
                                            @else
                                            <td>Đã thanh toán qua MoMo</td>
                                            @endif
                                            <td>
                                                <a href="{{route('order.detail', $val->id)}}">Chi tiết đơn hàng</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    @else
                                    <tbody>
                                        <tr>
                                            <td class="text-center p-0" colspan="8">
                                                <p class="mb-5 mt-5">
                                                    Bạn chưa có đơn hàng nào
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endif
                                </table>
                                <hr class="mt-0 mb-3 pb-2" />

                                <a href="{{route('product-list')}}" class="btn btn-dark">Đến sản phẩm</a>
                            </div>
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="change_pass" role="tabpanel">
                        <div class="change-password">
                            <h3 class="text-uppercase mb-2" style="text-align: center">Thay đổi mật khẩu</h3>
                        <form action="{{route('profile.change_pass')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Nhập mật khẩu cũ <span class="required">*</span></label>
                                <input type="password" class="form-control" name="old_pass" />
                                @error('old_pass')
                                <small class="form-text text-muted">
                                  <div style="color:red">{{$message}}</div>
                                </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nhập mật khẩu mới <span class="required">*</span></label>
                                <input type="password" class="form-control" name="new_pass" />
                                @error('new_pass')
                                <small class="form-text text-muted">
                                  <div style="color:red">{{$message}}</div>
                                </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Xác nhận mật khẩu mới <span class="required">*</span></label>
                                <input type="password" class="form-control" name="confirm_pass" />
                                @error('confirm_pass')
                                <small class="form-text text-muted">
                                  <div style="color:red">{{$message}}</div>
                                </small>
                                @enderror
                            </div>
                            <div class="form-footer mt-3 mb-0 justify-content-center">
                                <button type="submit" class="btn btn-primary mr-0">
                                    Lưu thay đổi
                                </button>
                            </div>
                        </form>

                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="address" role="tabpanel">
                        <h3 class="account-sub-title d-none d-md-block mb-1"><i
                                class="sicon-location-pin align-middle mr-3"></i>Addresses</h3>
                        <div class="addresses-content">
                            <p class="mb-4">
                                The following addresses will be used on the checkout page by
                                default.
                            </p>

                            <div class="row">
                                <div class="address col-md-6">
                                    <div class="heading d-flex">
                                        <h4 class="text-dark mb-0">Billing address</h4>
                                    </div>

                                    <div class="address-box">
                                        You have not set up this type of address yet.
                                    </div>

                                    <a href="#billing" class="btn btn-default address-action link-to-tab">Add
                                        Address</a>
                                </div>

                                <div class="address col-md-6 mt-5 mt-md-0">
                                    <div class="heading d-flex">
                                        <h4 class="text-dark mb-0">
                                            Shipping address
                                        </h4>
                                    </div>

                                    <div class="address-box">
                                        You have not set up this type of address yet.
                                    </div>

                                    <a href="#shipping" class="btn btn-default address-action link-to-tab">Add
                                        Address</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="edit" role="tabpanel">
                        <h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1">
                            <div class="col-md-4 text-center text-white d-flex justify-content-start align-items-center"
                            style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <img src="{{url('assets')}}/images/clients/client-1.jpg"
                              alt="Avatar" class="img-fluid my-5 mb-0" style="width: 120px;" />
                            <div class="d-flex justify-content-center align-items-center flex-column p-3" style="justify-content: start !important;">
                              <h5 class="mt-3 mb-1">{{Auth::user()->name}}</h5>
                            </div>
                          </div>
                                <div class="account-content">
                                    <form action="{{route('profile.update')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                    <label style="font-weight: bold;">Họ tên</label>
                                                    <input type="text" class="form-control" placeholder="Họ tên"
                                                      name="name" value="{{Auth::user()->name}}"/>
                                                      @error('name')
                                                      <small class="form-text text-muted">
                                                        <div style="color:red">{{$message}}</div>
                                                      </small>
                                                      @enderror
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label style="font-weight: bold;">Tên đăng nhập</label>
                                                    <input type="text" class="form-control" placeholder="Tên đăng nhập"
                                                      name="login_name" value="{{Auth::user()->login_name}}"/>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label style="font-weight: bold;">Email</label>
                                                    <input type="email" class="form-control" name="email"
                                                        placeholder="Địa chỉ email" value="{{Auth::user()->email}}" />
                                                        @error('email')
                                                        <small class="form-text text-muted">
                                                          <div style="color:red">{{$message}}</div>
                                                        </small>
                                                        @enderror
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label style="font-weight: bold;">Số điện thoại</label>
                                                    <input type="text" class="form-control" name="phone"
                                                        placeholder="Nhập số điện thoại" value="{{Auth::user()->phone}}" />
                                                </div>
                                                {{-- <div class="form-group mb-2">
                                                    <label style="font-weight: bold;">Ảnh đại diện</label>
                                                    <input type="file" class="form-control" name="image">
                                                </div> --}}
                                                <div class="form-group mb-2">
                                                    <label style="font-weight: bold;">Mật khẩu <span class="required">*</span></label>
                                                    <input type="password" class="form-control" name="password"
                                                        placeholder="Nhập mật khẩu để lưu thay đổi"/>
                                                        @error('password')
                                                        <small class="form-text text-muted">
                                                          <div style="color:red">{{$message}}</div>
                                                        </small>
                                                        @enderror
                                                </div>
                                                <div class="form-footer mt-3 mb-0">
                                                    <button type="submit" class="btn btn-primary mr-0">
                                                        Lưu thay đổi
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="billing" role="tabpanel">
                        <div class="address account-content mt-0 pt-2">
                            <h4 class="title">Billing address</h4>

                            <form class="mb-2" action="#">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First name <span class="required">*</span></label>
                                            <input type="text" class="form-control" required />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last name <span class="required">*</span></label>
                                            <input type="text" class="form-control" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Company </label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="select-custom">
                                    <label>Country / Region <span class="required">*</span></label>
                                    <select name="orderby" class="form-control">
                                        <option value="" selected="selected">British Indian Ocean Territory
                                        </option>
                                        <option value="1">Brunei</option>
                                        <option value="2">Bulgaria</option>
                                        <option value="3">Burkina Faso</option>
                                        <option value="4">Burundi</option>
                                        <option value="5">Cameroon</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Street address <span class="required">*</span></label>
                                    <input type="text" class="form-control"
                                        placeholder="House number and street name" required />
                                    <input type="text" class="form-control"
                                        placeholder="Apartment, suite, unit, etc. (optional)" required />
                                </div>

                                <div class="form-group">
                                    <label>Town / City <span class="required">*</span></label>
                                    <input type="text" class="form-control" required />
                                </div>

                                <div class="form-group">
                                    <label>State / Country <span class="required">*</span></label>
                                    <input type="text" class="form-control" required />
                                </div>

                                <div class="form-group">
                                    <label>Postcode / ZIP <span class="required">*</span></label>
                                    <input type="text" class="form-control" required />
                                </div>

                                <div class="form-group mb-3">
                                    <label>Phone <span class="required">*</span></label>
                                    <input type="number" class="form-control" required />
                                </div>

                                <div class="form-group mb-3">
                                    <label>Email address <span class="required">*</span></label>
                                    <input type="email" class="form-control" placeholder="editor@gmail.com"
                                        required />
                                </div>

                                <div class="form-footer mb-0">
                                    <div class="form-footer-right">
                                        <button type="submit" class="btn btn-dark py-4">
                                            Save Address
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="shipping" role="tabpanel">
                        <div class="address account-content mt-0 pt-2">
                            <h4 class="title mb-3">Shipping Address</h4>

                            <form class="mb-2" action="#">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First name <span class="required">*</span></label>
                                            <input type="text" class="form-control" required />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last name <span class="required">*</span></label>
                                            <input type="text" class="form-control" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Company </label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="select-custom">
                                    <label>Country / Region <span class="required">*</span></label>
                                    <select name="orderby" class="form-control">
                                        <option value="" selected="selected">British Indian Ocean Territory
                                        </option>
                                        <option value="1">Brunei</option>
                                        <option value="2">Bulgaria</option>
                                        <option value="3">Burkina Faso</option>
                                        <option value="4">Burundi</option>
                                        <option value="5">Cameroon</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Street address <span class="required">*</span></label>
                                    <input type="text" class="form-control"
                                        placeholder="House number and street name" required />
                                    <input type="text" class="form-control"
                                        placeholder="Apartment, suite, unit, etc. (optional)" required />
                                </div>

                                <div class="form-group">
                                    <label>Town / City <span class="required">*</span></label>
                                    <input type="text" class="form-control" required />
                                </div>

                                <div class="form-group">
                                    <label>State / Country <span class="required">*</span></label>
                                    <input type="text" class="form-control" required />
                                </div>

                                <div class="form-group">
                                    <label>Postcode / ZIP <span class="required">*</span></label>
                                    <input type="text" class="form-control" required />
                                </div>

                                <div class="form-footer mb-0">
                                    <div class="form-footer-right">
                                        <button type="submit" class="btn btn-dark py-4">
                                            Save Address
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->
@endsection
