<?php
namespace App\Http\Controllers;
use App\Mail\VerifyAccount;
use App\Mail\FogotPass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\UserResetToken;

class   UserController extends Controller
{
    public function register()
    {
        $data['header_title'] = 'Đăng ký';
        return view('frontend.auth.register', $data);
    }

    public function post_register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:6|max:100',
            'email' => 'required|email|min:6|max:100|unique:users',
            'password' => 'required|min:6|max:20',
            'confirm_password' => 'required|same:password',
        ], [
            'required' => ':attribute không được để trống.',
             'email.email' => ':attribute phải là một địa chỉ email hợp lệ.',
             'min' => ':attribute phải lớn hơn :min kí tự',
             'max' => ':attribute phải nhỏ hơn :max kí tự',
             'unique' => ':attribute đã tồn tại trong hệ thống',
             'same' => 'Mật khẩu không trùng khớp',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'token_verify_email' => Str::random(40),
        ];
        if($acc = User::create($data))
        {
            Mail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('login')->with('success', "Đâng ký tài khoản thành công, vui lòng kiểm tra email để xác thực tài khoản");
        }
        else return redirect()->back();
    }

    public function verify($token)
    {
        User::where('token_verify_email', $token)->firstOrFail();

        User::where('token_verify_email', $token)->update([
            'status' => 1,
            'token_verify_email' => null,
            'email_verified_at' => Carbon::now(),
        ]);

        return redirect()->route('login')->with('success', 'Xác thực tài khoản thành công, bạn đã có thể đăng nhập.');
    }

    public function forgot()
    {
        $data['header_title'] = 'Quên mật khẩu';
        return view('frontend.auth.forgot', $data);
    }

    public function post_forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users',
        ], [
            'required' => ':attribute không được để trống.',
            'exists' => ':attribute không tồn tại trong hệ thống',
        ]);

        $acc = User::where('email', $request->email)->first();

        $token = Str::random(40);

        $token_data = [
            'email' => $request->email,
            'token' => $token,
        ];

        if(UserResetToken::create($token_data))
        {
            Mail::to($request->email)->send(new FogotPass($acc, $token));
            return redirect()->back()->with('success', "Gửi email thành công, vui lòng kiểm tra email để tiếp tục");
        }
        else return redirect()->back()->with('error', "Gửi email thất bại, vui lòng kiểm tra lại");
    }

    public function reset_pass($token)
    {
        $data['header_title'] = 'Reset pass';

        $token_data = UserResetToken::where('token', $token)->firstOrFail();
        $user = User::where('email', $token_data->email)->firstOrFail();
        // $user = $token_data->user();
        return view('frontend.auth.reset_pass', $data);
    }

    public function post_resetPass(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|min:6|max:20',
            'confirm_password' => 'required|same:password',
        ], [
            'required' => ':attribute không được để trống.',
             'min' => ':attribute phải lớn hơn :min kí tự',
             'max' => ':attribute phải nhỏ hơn :max kí tự',
             'same' => 'Mật khẩu không trùng khớp',
        ]);

        $token_data = UserResetToken::where('token', $token)->firstOrFail();
        $user = User::where('email', $token_data->email)->firstOrFail();
        // $user = $token_data->user();
        $password = Hash::make($request->password);

        $user->update(['password' => $password]);

        return redirect()->route('login')->with('success', 'Lấy lại mật khẩu thành công!');
    }
}
?>