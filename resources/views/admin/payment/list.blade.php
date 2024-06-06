@extends('admin.layouts.main')
@section('style')

@endsection


@section('content')

<div class="content-wrapper">
    <div class="p-3 d-flex justify-content-between align-items-center">
        <p class="h2">Phương thức thanh toán</p>
        <a href="{{route('payment.add')}}" class="btn btn-primary">Thêm mới</a>
    </div>
    <table class="table ">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Tên</th>
            <th scope="col">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @if(!empty($list_payment))
            @foreach($list_payment as $value)
              <tr>
                <th scope="row">{{$value->id}}</th>
                <td>{{$value->name}}</td>
                <td>
                  <a href="{{route('payment.edit', $value->id)}}" class="btn btn-primary">Sửa</a>
                  <a href="#" class="btn btn-danger" onclick="confirmDelete('{{ route('payment.delete', $value->id) }}')">Xóa</a>
                </td> 
              </tr>
            @endforeach
          @else <p class="text-center">Không có PT thanh toán nào</p>
          @endif
        </tbody>
      </table>
</div>

@endsection

@section('scripts')
<script>
  function confirmDelete(deleteUrl) {
      if (confirm("Bạn có chắc chắn muốn xóa?")) {
          window.location.href = deleteUrl;
      } else {
          // Không làm gì nếu người dùng chọn "Cancel"
      }
  }
</script>
@endsection