@extends('admin.layouts.main')
@section('style')

@endsection


@section('content')

<div class="content-wrapper">
    <div class="p-3 d-flex justify-content-between align-items-center">
        <p class="h2">Thêm mới</p>
        <a href="{{route('account.list')}}" class="btn btn-primary">Hủy</a>
    </div>
    <form class="m-4" action="" method="POST">
        @csrf
        <div class="form-group">
            <label>Tên</label>
            <input type="text" class="form-control" value="{{old('name')}}" name="name" placeholder="Tên">
            @error('name')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div>
        <div class="form-group">
          <label>Email </label>
          <input type="email" class="form-control" value="{{old('email')}}" name="email" placeholder="Email">
          @error('email')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div>
        <div class="form-group">
          <label>Mật khẩu</label>
          <input type="password" class="form-control" value="{{old('password')}}" name="password" placeholder="Mật khẩu">
          @error('password')
            <small class="form-text text-muted">
              <div style="color:red">{{$message}}</div>
            </small>
            @enderror
        </div>
        <div class="form-group">
            <label>Xác nhận mật khẩu</label>
            <input type="password" class="form-control" value="{{old('password')}}" name="confirm_password" placeholder="Xác nhận mật khẩu">
            @error('confirm_password')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
              @enderror
          </div>
        <div class="form-group">
            <label>Phân loại</label>
            <select class="form-control" name="role">
                <option value="0" value="{{(old('role') == 0) ? 'selected' : ''}}">Khách hàng</option>
                <option value="1" value="{{(old('role') == 1) ? 'selected' : ''}}">Admin</option>
            </select>
            <small class="form-text text-muted"></small>
        </div>
        
        <button type="submit" class="btn btn-primary">Thêm</button>
      </form>
    
</div>

@endsection

@section('script')

@endsection