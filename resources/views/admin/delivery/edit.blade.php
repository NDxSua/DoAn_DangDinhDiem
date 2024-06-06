@extends('admin.layouts.main')
@section('style')

@endsection


@section('content')

<div class="content-wrapper">
    <div class="p-3 d-flex justify-content-between align-items-center">
        <p class="h2">Chỉnh sửa</p>
        <a href="{{route('color.list')}}" class="btn btn-primary">Hủy</a>
    </div>
    <form class="m-4" action="" method="POST">
        @csrf
        <div class="form-group">
            <label>Tên</label>
            <input type="text" class="form-control" value="{{old('name', $delivery_edit->name)}}" name="name" placeholder="Tên">
            @error('name')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div> 
        <div class="form-group">
            <label>Phí vận chuyển</label>
            <input type="text" class="form-control" value="{{old('name', $delivery_edit->value)}}" name="value" placeholder="Phí vận chuyển">
            @error('value')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div> 
        <button type="submit" class="btn btn-primary">Cập nhật</button>
      </form>
    
</div>

@endsection

@section('script')

@endsection