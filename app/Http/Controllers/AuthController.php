<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class   AuthController extends Controller
{
    public function login ()
    {
        $data['header_title'] = 'Đăng nhập';
        return view('frontend.auth.login', $data);
    }

    public function login_admin() {
        
        if(Auth::check()) {
            if(Auth::User()->roles == 1) return redirect()->route('admin.dashboard');               
            else {
                Auth::logout();
            }
        }
        return view('admin.auth.login');
    }

    public function post_login_admin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ], [
            'required' => ':attribute không được để trống.',
             'email.email' => ':attribute phải là một địa chỉ email hợp lệ.',
             'exists' => ':attribute không tồn tại trong hệ thống',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1]))
        {
            if(Auth::user()->roles == 0)
            {
                return redirect()->back()->with('error', "Không phải tài khoản Admin");
            }
            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập quản trị thành công!');
        }
        else return redirect()->back()->with('error', "email hoặc mật khẩu không chính xác");
    }

    public function post_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ], [
            'required' => ':attribute không được để trống.',
             'email.email' => ':attribute phải là một địa chỉ email hợp lệ.',
             'exists' => ':attribute không tồn tại trong hệ thống',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            if(Auth::user()->status == 0)
            {
                return redirect()->back()->with('error', "Tài khoản của bạn chưa được xác thực, vui lòng xác thực để đăng nhập");
            }
            else return redirect()->route('home')->with('success', 'Đăng nhập thành công');
        }
        else return redirect()->back()->with('error', "Sai email hoặc mật khẩu.");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function logout_admin()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
?>