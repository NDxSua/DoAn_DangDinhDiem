<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\OrderModel;

class   ProfileController extends Controller
{
    public function index ()
    {
        $data = [
            'header_title' => 'Trang cá nhân',
            'order' => OrderModel::getAllByUser(),
        ];
        
        return view('frontend.components.profile', $data);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|min:6|max:100',
            'email' => 'required|email|min:6|max:100|unique:users,email,'.$user->id,
            'password' => ['required', function($attr, $value, $fail) use($user){
                if(!Hash::check($value, $user->password)){
                    return $fail('Mật khẩu không đúng, vui lòng nhập lại!');
                }
            }],
        ], [
            'required' => ':attribute không được để trống.',
             'email.email' => ':attribute phải là một địa chỉ email hợp lệ.',
             'min' => ':attribute phải lớn hơn :min kí tự',
             'max' => ':attribute phải nhỏ hơn :max kí tự',
             'unique' => ':attribute đã tồn tại trong hệ thống',
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
        ];

        $check = User::where('id', $user->id)->update($data);
        if($check)
        {
            return redirect()->back()->with('success', 'Thay đổi thông tin tài khoản thành công.');
        }
        else return redirect()->back()->with('error', 'Thay đổi thất bại, vui lòng kiểm tra lại.');
        
    }

    public function change_pass(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'old_pass' => ['required', function($attr, $value, $fail) use($user){
                if(!Hash::check($value, $user->password)){
                    return $fail('Mật khẩu không đúng, vui lòng nhập lại!');
                }
            }],
            'new_pass' => 'required|min:6|max:20',
            'confirm_pass' => 'required|same:new_pass',
        ], [
            'required' => 'Không được để trống',
            'min' => 'Mật khẩu phải lớn hơn :min kí tự',
            'max' => 'Mật khẩu phải nhỏ hơn :max kí tự',
            'same' => 'Mật khẩu không trùng khớp'
        ]);

        $data['password'] = Hash::make($request->new_pass);
        $check = User::where('id', $user->id)->update($data);
        if($check)
        {
            return redirect()->back()->with('success', 'Thay đổi mật khẩu thành công.');
        }
        else return redirect()->back()->with('error', 'Thay đổi thất bại, vui lòng kiểm tra lại.');
    }

}
?>