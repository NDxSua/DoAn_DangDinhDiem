<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\OrderDetailModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list()
    {
        $data = [
            'header_title' => 'Đơn hàng',
            'list_order' => OrderModel::getAllByAdmin(),
        ];
        
        return view('admin.order.list', $data);
    }

    public function order_detail($id)
    {
        $data = [
            'header_title' => 'Chi tiết đơn hàng',
            'order_detail' => OrderDetailModel::getAll($id),
            'order' => OrderModel::getByID($id),
        ];

        return view('admin.order.order_detail', $data);
    }

    public function confirmOrder(Request $request) {
        $id = $request->id;
        $order = OrderModel::find($id);
        $order->status = 1;
        $order->save();
        return redirect()->back()->with('success', 'Xác nhận đơn hàng thành công');
    }

    public function deleteOrder(Request $request) {
        $id = $request->id;
        $order = OrderModel::find($id);
        if($order->status == 1) {
            return redirect()->back()->with('error', 'Bạn không thể hủy đơn hàng đang được giao');
        }
        $order->status = 4;
        $order->save();
        $order_detail = OrderDetailModel::getall($id);
        foreach($order_detail as $val)
        {
            $product = ProductModel::find($val->product_id);
            $product->quantity = $product->quantity + $val->quantity;
            $product->save();
        }
        return redirect()->back()->with('success', 'Hủy đơn hàng thành công');
    }

    public function successOrder(Request $request) {
        $id = $request->id;
        $order = OrderModel::find($id);
        $order->status = 3;
        $order->save();
        return redirect()->back()->with('success', 'Cảm ơn quý khách.');
    }

}
