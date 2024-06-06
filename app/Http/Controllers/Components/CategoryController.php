<?php
namespace App\Http\Controllers\Components;
use App\Http\Controllers\Controller;
use App\Models\ProductModel;

class CategoryController extends Controller
{
    // public function index()
    // {

    //     $product = ProductModel::getProduct();

    //     $data = [
    //         'header_title' => 'Danh mục',
    //         'product' => $product,
    //     ];

    //     return view('frontend.category', $data);
    // }

    public function product_cate($id)
    {
        $product = ProductModel::getProductByCateID($id);

        $data = [
            'header_title' => 'Danh mục',
            'product' => $product,
        ];

        return view('frontend.components.category', $data);
    }
}
?>