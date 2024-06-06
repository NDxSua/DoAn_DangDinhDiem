<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function list() {
        $data = [
            'header_title' => 'Danh mục',
            'list_cate' => CategoryModel::all(),
            ];
        
        return view('admin.category.list', $data);
    }

    public function add() {
        $data['header_title'] = 'Thêm mới';
        return view('admin.category.add', $data);
    }

    public function post_add(Request $request) {

        $request->validate([
            'name' => 'required',
        ], [
            'required' => ':attribute không được để trống',
        ]);
        $data = [
            'name' => $request->name,
            'patent_id' => $request->patent_id,
            'created_by' => Auth::user()->id,
        ];
        CategoryModel::create($data);

        return redirect()->route('category.list')->with('success', "Thêm mới danh mục thành công!");
    }

    public function edit($id) {
        $data['header_title'] = 'Sửa danh mục';
        $data['category_edit'] = CategoryModel::find($id);
        return view('admin.category.edit', $data);
    }

    public function post_edit($id, Request $request) {

        $request->validate([
            'name' => 'required',
        ], [
            'required' => ':attribute không được để trống',
        ]);
        $data = [
            'name' => $request->name,
            'patent_id' => $request->patent_id,
        ];
        if($data['patent_id'] === 'null') $data['patent_id'] = null;
        CategoryModel::where('id', $id)->update($data);
        
        return redirect()->route('category.list')->with('success', "Cập nhật danh mục thành công!");
    }

    public function delete($id) {
        $category = CategoryModel::find($id);       
        $category->delete();
        
        return redirect()->back()->with('success', "Xóa danh mục thành công!");
    }
}
