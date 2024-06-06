<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\imagesModel;
use App\Models\ColorModel;
use App\Models\ProductColorModel;

class ProductController extends Controller
{
    public function list()
    {
        $data = [
            'header_title' => 'Sản phẩm',
            'product' => ProductModel::getProductByAdmin(),
        ];

        return view('admin.product.list', $data);
    }

    public function add()
    {
        $data = [
            'header_title' => 'Thêm sản phẩm',
            'colors' => ColorModel::all(),
        ];

        return view('admin.product.add', $data);
    }

    public function post_add(Request $request)
    {
        //dd($request->sizes);
        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            'images.*' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ], [
            'required' => ':attribute không được để trống',
            'max' => ':attribute không được vượt quá max:2080',
        ]);
        DB::beginTransaction();
        try {
            $fileName = time().'.'.$request->image->getCLientOriginalExtension();
            $request->image->move(public_path('assets/uploads/products'), $fileName);
            
            $product = new ProductModel;
            $product->name = $request->name;
            $product->created_by = Auth::user()->id;
            $product->status = $request->status;
            $product->description = $request->description;
            $product->color = $request->color;
            $product->category_id = $request->category_id;
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->promotional_price = $request->promotional_price;
            $product->avatar_pro = $fileName;
            $product->status = 1;
        
            $product->save();
        
            // Lưu hình ảnh vào bảng images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $fileName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('assets/uploads/products'), $fileName);
        
                    // Tạo mới một bản ghi trong bảng product_image
                    $productImage = new imagesModel;
                    $productImage->product_id = $product->id; // ID của sản phẩm mới được tạo
                    $productImage->url = $fileName;
                    $productImage->save();
                }
            }

            // foreach ($request->colors as $color) {
            //     $colorNew = new ProductColorModel;
            //     $colorNew->product_id = $product->id; 
            //     $colorNew->color_id = $color;
            //     $colorNew->save();
            // }

            DB::commit();
            return redirect()->route('product.list')->with('success', "Thêm sản phẩm thành công.");
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Thêm thất bại, vui lòng thử lại.');
        }
    }

    public function edit($id)
    {
        $product = ProductModel::find($id);
        $data = [
            'header_title' => 'Sửa sản phẩm',
            'product' => $product,
            'product_images' => $product->images,
            // 'colors' => ColorModel::all(),
            // 'product_color' => $product->product_colors()->pluck('color_id')->toArray(),// lấy ra các màu của sản phẩm đang sửa
        ];
        return view('admin.product.edit', $data);
    }

    public function post_edit($id, Request $request) {

        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg',
            'images.*' => 'image|mimes:jpg,png,jpeg,gif,svg',
            // 'colors' => 'required',
        ], [
            'required' => 'The :attribute field is required',
            'max' => ':attribute must not exceed max:2080',
        ]);

        DB::beginTransaction();
        try {
            $fileName = $request->old_image;

            if(!empty($request->image)) {
                $fileName = time().'.'.$request->image->getCLientOriginalExtension();
                $request->image->move(public_path('assets/uploads/products'), $fileName);
            }


            $product = ProductModel::find($id);
            $product->name = $request->name;
            $product->created_by = Auth::user()->id;
            $product->status = $request->status;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->color = $request->color;
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->promotional_price = $request->promotional_price;
            $product->avatar_pro = $fileName;

            $product->save();

            if ($request->hasFile('images')) {
                imagesModel::where('product_id', $id)->delete();
                foreach ($request->file('images') as $image) {
                    $fileName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('assets/uploads/products'), $fileName);
        
                    // Tạo mới một bản ghi trong bảng product_image
                    $productImage = new imagesModel;
                    $productImage->product_id = $product->id; // ID của sản phẩm mới được tạo
                    $productImage->url = $fileName;
                    $productImage->save();
                }
            }
            // ProductColorModel::where('product_id', $id)->delete();
            // foreach ($request->colors as $color) {
            //     $colorNew = new ProductColorModel;
            //     $colorNew->product_id = $product->id; 
            //     $colorNew->color_id = $color;
            //     $colorNew->save();
            // }
            DB::commit();
            return redirect()->route('product.list')->with('success', "Cập nhật sản phẩm thành công.");
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Cập nhật thất bại, vui lòng thử lại.');
        }
    }

    public function delete($id) {
        $product = ProductModel::find($id);
        // $product->product_colors()->delete();
        $product->images()->delete();
        $product->delete();
        
        return redirect()->back()->with('success', "Xóa sản phẩm thành công.");
    }

}
