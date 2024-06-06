<h3>Xin chào, {{$account->name}}</h3>
<p>Click đường link bên dưới lấy lại mật khẩu</p>
<a href="{{route('reset_pass', $token)}}">Click vào đây để lấy lại mật khẩu</a>