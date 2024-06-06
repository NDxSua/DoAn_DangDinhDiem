<?php
namespace App\Http\Controllers;
use App\Models\ProductModel;

class   HomeController extends Controller
{
    public function index ()
    {
        $product = ProductModel::getProduct();

        $data = [
            'header_title' => 'Trang chủ',
            'product' => $product,
        ];

        return view('home', $data);
    }
}
?>