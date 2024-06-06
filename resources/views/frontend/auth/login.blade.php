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
                                Đăng nhập
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>Đăng nhập</h1>
            </div>
        </div>

        <div class="container login-container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="heading mb-1">
                                <h2 class="title" style="text-align: center">Đăng nhập</h2>
                            </div>

                            <form action="" method="POST">
                                @csrf
                                <div class="form-group mb-2">
                                    <label >Email <span class="required">*</span></label>
                                    <input type="email" class="form-control" name="email">
                                    @error('email')
                                    <small class="form-text text-muted">
                                      <div style="color:red">{{$message}}</div>
                                    </small>
                                    @enderror
                                </div>

                                <div class="form-group mb-2">
                                    <label >Mật khẩu <span class="required">*</span></label>
                                    <input type="password" class="form-control" name="password">
                                    @error('password')
                                    <small class="form-text text-muted">
                                      <div style="color:red">{{$message}}</div>
                                    </small>
                                    @enderror
                                </div>

                                <div class="form-footer mb-2">
                                    {{-- <div class="custom-control custom-checkbox mb-0">
                                        <input type="checkbox" class="custom-control-input" id="lost-password" />
                                        <label class="custom-control-label mb-0" for="lost-password">Remember
                                            me</label>
                                    </div> --}}

                                    <a href="{{route('forgot_pass')}}"
                                        class="forget-password text-dark form-footer-right">Quên  mật khẩu?</a>
                                </div>
                                <button type="submit" class="btn btn-primary btn-md w-100 mb-2">
                                    Đăng nhập
                                </button>
                                <p>Chưa có tài khoản? <a href="{{route('register')}}">Đăng ký ngay</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End .main -->

@endsection




