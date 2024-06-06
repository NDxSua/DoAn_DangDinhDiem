@extends('admin.layouts.main')
@section('styles')
<style>
  .preview-image {
    max-width: 100px; /* Đảm bảo hình ảnh không quá rộng */
    max-height: 100px; /* Đảm bảo hình ảnh không quá cao */
    margin-right: 10px; /* Khoảng cách giữa các hình ảnh */
}

.preview-single-image {
    max-width: 200px; /* Đảm bảo ảnh không quá rộng */
    max-height: 200px; /* Đảm bảo ảnh không quá cao */
}
</style>
@endsection


@section('content')

<div class="content-wrapper">
    <div class="p-3 d-flex justify-content-between align-items-center">
        <p class="h2">Sửa sản phẩm</p>
        <a href="{{route('product.list')}}" class="btn btn-primary">Hủy</a>
    </div>
    <form class="m-4" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Tên sản phẩm</label>
            <input type="text" class="form-control" value="{{old('name', $product->name)}}" name="name" placeholder="Tên sản phẩm">
            @error('name')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div>
        <div class="form-group">
          <label>Danh mục</label>
          <select class="form-control" name="category_id">
              @foreach($cate as $value)
                @if($value->id == $product->category_id)
                  <option value="{{$value->id}}" selected>{{$value->name}}</option>
                @else
                  <option value="{{$value->id}}">{{$value->name}}</option>
                @endif
              @endforeach
          </select>
      </div>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="description" class="form-control" placeholder="Mô tả" >{{old('description', $product->description)}}</textarea>
            @error('description')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div>
        <div class="form-group">
          <label class="form-label">Hình ảnh</label> <br>
          <input type="file" name="image" accept="image/*" id="imageMain"/>
          <div class="preview-main-image mt-2"></div>
          @error('image')
              <small class="form-text text-muted">
                  <div style="color:red">{{$message}}</div>
              </small>
          @enderror
        </div>
        <img src="{{asset('assets/uploads/products/'.$product->avatar_pro)}}" id="file" class="card-img-top" alt="" style="max-width: 200px">
        <input type="hidden" name="old_image" value="{{$product->avatar_pro}}" />
        <div class="form-group">
          <label class="form-label">Ảnh liên quan</label> <br>
          <input type="file" name="images[]" accept="image/*" id="imageInput" multiple/>
          <div class="preview-images mt-2"></div> <!-- Đây là nơi để hiển thị trước các hình ảnh -->
          <div id="displayImageOld"></div> <!-- Đây là nơi để hiển thị trước các hình ảnh -->
          @error('images')
              <small class="form-text text-muted">
                  <div style="color:red">{{$message}}</div>
              </small>
          @enderror
        </div>
        {{-- <div class="form-group">
          <label>Màu sắc</label> </br>
          @foreach($colors as $val)
          <label class="m-2">{{$val->name}}
            <input type="checkbox" name="colors[]" value="{{$val->id}}"
            @if(in_array($val->id, $product_color)) checked @endif />
          </label>
          @endforeach
          @error('colors')
            <small class="form-text text-muted">
              <div style="color:red">{{$message}}</div>
            </small>
          @enderror
        </div> --}}
        <div class="form-group">
          <label>Màu sắc</label>
          <input type="text" class="form-control" value="{{old('color', $product->color)}}" name="color" placeholder="Màu sắc">
          @error('color')
            <small class="form-text text-muted">
              <div style="color:red">{{$message}}</div>
            </small>
          @enderror
      </div>
        <div class="form-group">
            <label>Số lượng</label>
            <input type="text" class="form-control" value="{{old('quantity', $product->quantity)}}" name="quantity" placeholder=Số lượng">
            @error('quantity')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div>
        <div class="form-group">
            <label>Giá bán</label>
            <input type="text" class="form-control" value="{{old('price', $product->price)}}" name="price" placeholder="Giá bán">
            @error('price')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div>
        <div class="form-group">
            <label>Tình trạng</label>
            <select class="form-control" name="status">
                <option value="1" value="{{(old('email') == 1) ? 'selected' : ''}}">Active</option>
                <option value="0" value="{{(old('email') == 0) ? 'selected' : ''}}">Inactive</option>
            </select>
            <small class="form-text text-muted"></small>
        </div>
        
        <button type="submit" class="btn btn-primary mb-2">Cập nhật</button>
      </form>
    
</div>

@endsection

@section('scripts')
<script>
  var productImages = {!! json_encode($product_images) !!};

  displayImage(productImages);
  function displayImage(images) {
    var displayImageOld = document.getElementById('displayImageOld');
    displayImageOld.innerHTML = ''; // Xóa bỏ tất cả các hình ảnh hiện tại trong container

    images.forEach(function(image) {
        var imgElement = document.createElement('img');
        imgElement.src = '/assets/uploads/products/' + image.url;
        imgElement.alt = 'Image';
        imgElement.classList.add('preview-image'); // Thêm một class cho ảnh (tuỳ chọn)
        displayImageOld.appendChild(imgElement); // Thêm ảnh vào container
    });
  }
  //Image main preview
  document.getElementById('imageMain').addEventListener('change', function(event) {
    $('#file').addClass('d-none')
    var previewContainer = document.querySelector('.preview-main-image');
    previewContainer.innerHTML = '';
    var file = event.target.files[0];

    var reader = new FileReader();
    reader.onload = function(e) {
        var imgElement = document.createElement('img');
        imgElement.src = e.target.result;
        imgElement.classList.add('preview-single-image');
        previewContainer.appendChild(imgElement); // Thêm ảnh vào container
    }

    reader.readAsDataURL(file);
  });

  //Images preview
  document.getElementById('imageInput').addEventListener('change', function(event) {
  $('#displayImageOld').addClass('d-none')
  var previewContainer = document.querySelector('.preview-images');
  previewContainer.innerHTML = ''; // Xóa bỏ tất cả các hình ảnh hiện tại trong container

  var files = event.target.files;
  for (var i = 0; i < files.length; i++) {
      var file = files[i];
      var reader = new FileReader();

      reader.onload = function(e) {
          var imgElement = document.createElement('img');
          imgElement.src = e.target.result;
          imgElement.classList.add('preview-image');
          previewContainer.appendChild(imgElement); // Thêm hình ảnh vào container
      }

      reader.readAsDataURL(file); // Đọc dữ liệu của file hình ảnh
  }
});
</script>
@endsection