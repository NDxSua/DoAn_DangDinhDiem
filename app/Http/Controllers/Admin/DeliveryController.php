<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryModel;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function list()
    {
        $data = [
            'header_title' => 'Delivery',
            'list_delivery' => DeliveryModel::all(),
        ];
        return view('admin.delivery.list', $data);
    }

    public function add() {
        $data['header_title'] = 'Thêm mới';
        return view('admin.delivery.add', $data);
    }

    public function post_add(Request $request) {

        $request->validate([
            'name' => 'required',
            'value' => 'required',
        ], [
            'required' => ':attribute không được để trống',
        ]);
        $data = [
            'name' => $request->name,
            'value' => $request->value,
        ];
        DeliveryModel::create($data);

        return redirect()->route('delivery.list')->with('success', "Thêm mới PT vận chuyển thành công!");
    }

    public function edit($id) {
        $data['header_title'] = 'Sửa';
        $data['delivery_edit'] = DeliveryModel::find($id);
        return view('admin.delivery.edit', $data);
    }

    public function post_edit($id, Request $request) {

        $request->validate([
            'name' => 'required',
            'value' => 'required',
        ], [
            'required' => ':attribute không được để trống',
        ]);
        $data = [
            'name' => $request->name,
            'value' => $request->value,
        ];
        DeliveryModel::where('id', $id)->update($data);
        
        return redirect()->route('delivery.list')->with('success', "Cập nhật PT vận chuyển thành công!");
    }

    public function delete($id) {
        $delivery = DeliveryModel::find($id);  
        $delivery->delete();
        return redirect()->back()->with('success', "Xóa PT vận chuyển thành công!");
    }
}
