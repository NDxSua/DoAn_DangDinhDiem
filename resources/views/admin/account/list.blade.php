@extends('admin.layouts.main')
@section('style')

@endsection


@section('content')

<div class="content-wrapper">
    <div class="p-3 d-flex justify-content-between align-items-center">
        <p class="h2">Tài khoản</p>
        <a href="{{route('account.add')}}" class="btn btn-primary">Thêm mới</a>
    </div>

    <table class="table ">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Tên</th>
            <th scope="col">Email</th>
            <th scope="col">Tình trạng</th>
            <th scope="col">Vai trò</th>
            <th scope="col">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @if(!empty($list_acc))
            @foreach($list_acc as $admin)
              <tr>
                <th scope="row">{{$admin->id}}</th>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td>{{($admin->status) == 1 ? 'active' : 'inactive'}}</td>
                <td>{{($admin->roles) == 0 ? 'Khách hàng' : 'Admin'}}</td>
                <td>
                    {{-- <a href="#" class="btn btn-danger" onclick="confirmLock('{{ route('account.lock', $admin->id) }}')">Khóa</a> --}}
                  {{-- @if ($admin->is_deleted == 0)
                      <a href="{{ url('admin/admin/delete/'.$admin->id) }}" class="btn btn-danger">Lock</a>
                  @else
                      <a href="{{ url('admin/admin/unlock/'.$admin->id) }}" class="btn btn-info">Unlock</a>
                  @endif --}}
                    @if($admin->status == 1)
                        <a href="#" class="btn btn-danger" onclick="confirmLock('{{ route('account.lock', $admin->id) }}')">Khóa</a>
                    @else
                        <a href="#" class="btn btn-primary" onclick="confirmUnlock('{{ route('account.unLock', $admin->id) }}')">Mở khóa</a>
                    @endif
                </td> 
              </tr>
            @endforeach
          @else <p class="text-center">Không có admin nào</p>
          @endif
        </tbody>
      </table>
</div>

@endsection

@section('scripts')
    <script>
        function confirmLock(lockUrl) {
            if (confirm("Bạn có chắc chắn muốn khóa?")) {
                window.location.href = lockUrl;
            } else {
                // Không làm gì nếu người dùng chọn "Cancel"
            }
        };
        function confirmUnlock(unlockUrl) {
            if (confirm("Bạn có chắc chắn muốn mở khóa?")) {
                window.location.href = unlockUrl;
            } else {
                // Không làm gì nếu người dùng chọn "Cancel"
            }
        }
    </script>
@endsection