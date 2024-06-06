<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ColorModel;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function list()
    {
        $data = [
            'header_title' => 'Màu sắc',
            'list_color' => ColorModel::all(),
        ];
        return view('admin.color.list', $data);
    }

    public function add() {
        $data['header_title'] = 'Thêm mới';
        return view('admin.color.add', $data);
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
        ColorModel::create($data);

        return redirect()->route('color.list')->with('success', "Thêm mới màu sắc thành công!");
    }

    public function edit($id) {
        $data['header_title'] = 'Sửa màu sắc';
        $data['color_edit'] = ColorModel::find($id);
        return view('admin.color.edit', $data);
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
        ColorModel::where('id', $id)->update($data);
        
        return redirect()->route('color.list')->with('success', "Cập nhật màu sắc thành công!");
    }

    public function delete($id) {
        $color = ColorModel::find($id);
        $color->product_color()->delete();   
        $color->delete();
        return redirect()->back()->with('success', "Xóa màu sắc thành công!");
    }
}
