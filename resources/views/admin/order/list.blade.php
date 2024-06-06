@extends('admin.layouts.main')
@section('style')

@endsection


@section('content')

<div class="content-wrapper">
    <div class="p-3 d-flex justify-content-between align-items-center">
        <p class="h2">Danh sách đơn hàng</p>
        {{-- <a href="{{url('admin/product/add')}}" class="btn btn-primary">Thêm sản phẩm mới</a> --}}
    </div>
    
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Họ tên</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Giá</th>
            <th scope="col">Tình trạng</th>
            <th scope="col">Ngày đặt</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @if(!empty($list_order))
            @foreach($list_order as $value)
              <tr>
                <th scope="row">{{$value->id}}</a></th>
                <td>{{$value->fullname}}</td>
                <td>{{$value->phone}}</td>
                <td>{{ number_format($value->amount, 0, ',', '.') }}đ</td>
                <td>
                    @php
                        if ($value->status == 0) {
                            echo 'Đang xử lý';
                        } elseif ($value->status == 1) {
                            echo 'Đang giao hàng';
                        } elseif ($value->status == 4) {
                            echo 'Đơn hàng đã bị hủy';
                        } else {
                            echo 'Đã nhận hàng';
                        }
                    @endphp
                </td>
                <td>{{$value->created_at}}</td>
                <th scope="row"><a href="{{ route('order_detail', $value->id) }}">Xem chi tiết</a></th>
              </tr>
            @endforeach
          @else <p class="text-center">Không tìm thấy đơn hàng</p>
          @endif
        </tbody>
      </table>
      <hr>
      <div>
        {{$list_order->appends(request()->all())->links()}}
      </div>
</div>

@endsection

@section('script')

@endsection