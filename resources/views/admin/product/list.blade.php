@extends('admin.layouts.main')
@section('style')

@endsection


@section('content')

<div class="content-wrapper">
    <div class="p-3 d-flex justify-content-between align-items-center">
        <p class="h2">Danh sách sản phẩm</p>
        <a href="{{route('product.add')}}" class="btn btn-primary">Thêm mới</a>
    </div>
    
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Ảnh</th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col-2" style="width: 30%">Mô tả</th>
            <th scope="col">Danh mục</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Giá</th>
            <th scope="col">Tình trạng</th>
            <th scope="col" style="min-width: 150px;">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @if(!empty($product))
            @foreach($product as $val)
              <tr>
                <th scope="row">{{$val->id}}</th>
                <td>
                  <img src="{{url('assets')}}/uploads/products/{{$val->avatar_pro}}" class="card-img-top" alt="..." style="max-width: 150px">
                </td>
                <td>{{$val->name}}</td>
                <td>{{$val->description}}</td>
                <td>{{$val->cate_name}}</td>
                <td>{{$val->quantity}}</td>
                <td>{{number_format((int) $val->price, 0, ',', '.')}}đ</td>
                <td>{{($val->status) == 1 ? 'active' : 'inactive'}}</td>
                <td>
                  <a href="{{route('product.edit', $val->id)}}" class="btn btn-primary">Sửa</a>
                  <a href="#" class="btn btn-danger" onclick="confirmDelete('{{ route('product.delete', $val->id) }}')">Xóa</a>
                </td> 
              </tr>
            @endforeach
          @else <p class="text-center">Không có sản phẩm nào</p>
          @endif
        </tbody>
      </table>
      <hr>
      <div>
        {{$product->appends(request()->all())->links()}}
      </div>
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