@extends('frontend.layouts.main')

@section('content')

    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="{{route('login')}}">Đăng nhập</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Lấy lại mật khẩu
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>Lấy lại mật khẩu</h1>
            </div>
        </div>

        <div class="container login-container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="heading mb-1">
                                <h2 class="title" style="text-align: center">Lấy lại mật khẩu</h2>
                            </div>

                            <form action="" method="POST">
                                @csrf
                                <div class="form-group mb-2">
                                    <label >Mật khẩu <span class="required">*</span></label>
                                    <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu mới">
                                    @error('password')
                                    <small class="form-text text-muted">
                                      <div style="color:red">{{$message}}</div>
                                    </small>
                                    @enderror
                                </div>

                                <div class="form-group mb-2">
                                    <label >Xác nhận mật khẩu <span class="required">*</span></label>
                                    <input type="password" class="form-control" name="confirm_password" placeholder="Xác nhận mật khẩu">
                                    @error('confirm_password')
                                    <small class="form-text text-muted">
                                      <div style="color:red">{{$message}}</div>
                                    </small>
                                    @enderror
                                </div>

                                    <button type="submit" class="btn btn-primary btn-md w-100 mr-0 mb-2">
                                        Xác nhận
                                    </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End .main -->

@endsection




