<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetailModel;
use App\Models\OrderModel;

class OrderDetailController extends Controller
{
    public function index($order_id)
    {
        $data = [
            'header_title' => 'Chi tiết đơn hàng',
            'order_detail' => OrderDetailModel::getAll($order_id),
            'order' => OrderModel::getByID($order_id),
            'SumPrice' => OrderDetailModel::getSumPriceByAdmin($order_id),
        ];
        return view('frontend.components.orderDetails', $data);
    }
}
