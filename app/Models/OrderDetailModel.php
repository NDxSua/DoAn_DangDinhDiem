<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OrderDetailModel extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'status',
    ];

    static public function getAll($order_id)
    {
        return self::select('order_details.*','products.name as product_name', 'products.avatar_pro as avt_pro', 'products.color as color')
        ->join('products', 'order_details.product_id', '=', 'products.id')
        ->where('order_id', $order_id)
        ->get();
    }


    public static function getTotalIncomeLast6Months()
    {
        // Mảng chứa tổng thu nhập của 6 tháng gần nhất
        $totalIncomes = [];

        // Lặp qua 12 tháng gần nhất
        for ($i = 11; $i >= 0; $i--)
        {
            // Tính thời gian đầu tiên của tháng
            $startOfMonth = Carbon::now()->subMonths($i)->startOfMonth();

            // Tính thời gian cuối của tháng
            $endOfMonth = Carbon::now()->subMonths($i)->endOfMonth();

            // Lấy tổng thu nhập của tháng đang xét
            $totalIncome = self::selectRaw('IFNULL(SUM(price), 0) AS total_amount')
                ->join('orders', 'orders.id', 'order_details.order_id')
                ->where('orders.status', 3)//chỉ tính đơn hàng đã giao thành công
                ->whereBetween('order_details.created_at', [$startOfMonth, $endOfMonth])
                ->first();

            // Thêm tổng thu nhập vào mảng
            $totalIncomes[] = $totalIncome->total_amount;
        }
        return $totalIncomes;
    }

    public static function getProductTopSelling($monthAgo)
    {
        // $search = Carbon::now()->subMonths($monthAgo);
        // $listProducts = OrderDetailModel::selectRaw('products.*, SUM(order_details.quantity) AS total_quantity')
        //                 ->join('products', 'products.id', '=', 'order_details.product_id')
        //                 ->join('orders', 'orders.id', 'order_details.order_id')
        //                 ->where('orders.status', 3)//chỉ tính đơn hàng đã giao thành công
        //                 ->where('order_details.created_at', '>=', $search)
        //                 ->orderByDesc('total_quantity')
        //                 ->groupBy('order_details.product_id')
        //                 ->limit(5)
        //                 ->get();                  
        // return $listProducts;
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        if ($monthAgo > 0) {
            $startDate = Carbon::now()->subMonths($monthAgo - 1)->startOfMonth();
        }

        $listProducts = OrderDetailModel::selectRaw('products.*, SUM(order_details.quantity) AS total_quantity')
                        ->join('products', 'products.id', '=', 'order_details.product_id')
                        ->join('orders', 'orders.id', 'order_details.order_id')
                        ->where('orders.status', 3)//chỉ tính đơn hàng đã giao thành công
                        ->whereBetween('order_details.created_at', [$startDate, $endDate])
                        ->orderByDesc('total_quantity')
                        ->groupBy('order_details.product_id')
                        ->limit(5)
                        ->get();

        return $listProducts;

    }
    static function getSumPriceByAdmin($order_id)
    {
        $SumPrice = self::selectRaw('IFNULL(SUM(price), 0) AS total_amount')
        ->where('order_id', $order_id)
        ->get();
        return $SumPrice;
    }
}
