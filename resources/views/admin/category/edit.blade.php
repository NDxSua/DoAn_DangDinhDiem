@extends('admin.layouts.main')
@section('style')

@endsection


@section('content')

<div class="content-wrapper">
    <div class="p-3 d-flex justify-content-between align-items-center">
        <p class="h2">Chỉnh sửa</p>
        <a href="{{route('category.list')}}" class="btn btn-primary">Hủy</a>
    </div>
    <form class="m-4" action="" method="POST">
        @csrf
        <div class="form-group">
            <label>Tên</label>
            <input type="text" class="form-control" value="{{old('name', $category_edit->name)}}" name="name" placeholder="Tên">
            @error('name')
              <small class="form-text text-muted">
                <div style="color:red">{{$message}}</div>
              </small>
            @enderror
        </div>
        <div class="form-group">
            <label>Danh mục con của</label>
            <select class="form-control" name="patent_id" >
                <option value="null">Không</option>
                @foreach($category as $value)
                    @if($value->id == $category_edit->patent_id)
                        <option value="{{$value->id}}" selected>{{$value->name}}</option>
                    @else
                        <option value="{{$value->id}}">{{$value->name}}</option>
                    @endif
                @endforeach
            </select>
            @error('patent_id')
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