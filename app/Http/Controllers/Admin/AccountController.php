<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function list()
    {
        $data = [
            'header_title' => 'Tài khoản',
            'list_acc' => User::all(),
        ];
        return view('admin.account.list', $data);
    }

    public function add()
    {
        $data = [
            'header_title' => 'Thêm tài khoản',
        ];
        return view('admin.account.add', $data);
    }

    public function post_add(Request $request)
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
            'roles' => $request->role,
            'status' => 1,
        ];
        User::create($data);
        return redirect()->route('account.list')->with('success', "Thêm mới tài khoản thành công!");
    }

    public function lock($id)
    {
        User::where('id', $id)->update(['status' => 0]);
        return redirect()->back()->with('success', 'Khóa tài khoản thành công!');
    }

    public function unLock($id)
    {
        User::where('id', $id)->update(['status' => 1]);
        return redirect()->back()->with('success', 'Mở khóa tài khoản thành công!');
    }
}
