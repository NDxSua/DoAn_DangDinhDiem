<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use App\Models\imagesModel;
use App\Models\Product_attribute;
use App\Models\ProductModel;
use App\Models\CommentModel;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function listproduct()
    {

        $data = [
            'header_title' => 'Sản phẩm',
            'product' => ProductModel::getProduct(),
        ];

        return view('frontend.components.category', $data);
    }

    public function product_detail($id)
    {

        $data = [
            'header_title' => 'Sản phẩm',
            'product' => ProductModel::find($id),
            'images' => imagesModel::where('product_id', $id)->get(),
            'pro_att' => Product_attribute::getAttbyProductID($id),
            'pro_cmt' => CommentModel::getCommentByID($id),
        ];

        return view('frontend.components.product-detail', $data);
    }

    public function searchProduct(Request $request)
    {
        $name = $request->input('search');        
        $product = ProductModel::searchProduct($name);

        $data = [
            'header_title' => 'Sản phẩm',
            'product' => $product,
        ];

        return view('frontend.components.category', $data);
    }
}
