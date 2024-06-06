@extends('admin.layouts.main')
@section('style')

@endsection


@section('content')

<div class="content-wrapper">
    <div class="p-3 d-flex justify-content-between align-items-center">
        <p class="h2">Phương thức vận chuyển</p>
        <a href="{{route('delivery.add')}}" class="btn btn-primary">Thêm mới</a>
    </div>
    <table class="table ">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Tên</th>
            <th scope="col">Phí</th>
            <th scope="col">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @if(!empty($list_delivery))
            @foreach($list_delivery as $value)
              <tr>
                <th scope="row">{{$value->id}}</th>
                <td>{{$value->name}}</td>
                <td>{{number_format((int) $value->value, 0, ',', '.')}}đ</td>
                <td>
                  <a href="{{route('delivery.edit', $value->id)}}" class="btn btn-primary">Sửa</a>
                  <a href="#" class="btn btn-danger" onclick="confirmDelete('{{ route('delivery.delete', $value->id) }}')">Xóa</a>
                </td> 
              </tr>
            @endforeach
          @else <p class="text-center">Không có PT vận chuyển nào</p>
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