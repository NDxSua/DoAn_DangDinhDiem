<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentsModel;

class PaymentController extends Controller
{
    public function list()
    {
        $data = [
            'header_title' => 'Payment',
            'list_payment' => PaymentsModel::all(),
        ];
        return view('admin.payment.list', $data);
    }

    public function add() {
        $data['header_title'] = 'Thêm mới';
        return view('admin.payment.add', $data);
    }

    public function post_add(Request $request) {

        $request->validate([
            'name' => 'required',
        ], [
            'required' => ':attribute không được để trống',
        ]);
        $data = [
            'name' => $request->name,
        ];
        PaymentsModel::create($data);

        return redirect()->route('payment.list')->with('success', "Thêm mới PT thanh toán thành công!");
    }

    public function edit($id) {
        $data['header_title'] = 'Sửa';
        $data['payment_edit'] = PaymentsModel::find($id);
        return view('admin.payment.edit', $data);
    }

    public function post_edit($id, Request $request) {

        $request->validate([
            'name' => 'required',
        ], [
            'required' => ':attribute không được để trống',
        ]);
        $data = [
            'name' => $request->name,
        ];
        PaymentsModel::where('id', $id)->update($data);
        
        return redirect()->route('payment.list')->with('success', "Cập nhật PT thanh toán thành công!");
    }

    public function delete($id) {
        $payment = PaymentsModel::find($id); 
        $payment->delete();
        return redirect()->back()->with('success', "Xóa PT thanh toán thành công!");
    }
}
