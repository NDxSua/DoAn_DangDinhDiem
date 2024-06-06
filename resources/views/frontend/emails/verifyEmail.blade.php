<h3>Xin chào, {{$account->name}}</h3>
<p>Click đường link bên dưới để xác thực</p>
<a href="{{route('verifyEmail', $account->token_verify_email)}}">Click vào đây để xác thực tài khoản</a>