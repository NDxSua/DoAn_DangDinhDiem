<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderDetailModel;
use App\Models\PaymentModel;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'fullname',
        'phone',
        'email',
        'province',
        'district',
        'street_address',
        'note',
        'total',
        'delivery_id',
        'payment_id',
        'status',
    ];

    public function order_detail()
    {
        return $this->hasMany(OrderDetailModel::class, 'order_id');
    }

    public function payments()
    {
        return $this->hasMany(PaymentModel::class, 'order_id');
    }

    static public function getAllByUser()
    {
        if(Auth::check())
        {
            return self::select('orders.*', 'deliveries.name as delivery_name', 'payments.status as payment_status')
            ->join('deliveries', 'orders.delivery_id', '=', 'deliveries.id')
            ->join('payments', 'orders.id', '=', 'payments.order_id')
            ->where('user_id', Auth::user()->id)
            ->orderBy('orders.id', 'desc')
            ->paginate(8);
        }
        else return [];
    }

    static function getByID($id)
    {
        return self::select('orders.*', 'deliveries.name as delivery_name', 'payments.payment_method as payment_method')
        ->join('deliveries', 'orders.delivery_id', '=', 'deliveries.id')
        ->join('payments', 'orders.id', '=', 'payments.order_id')
        ->where('orders.id', $id)
        ->get();
    }
    static function getAllByAdmin()
    {
        return self::select('orders.*', 'payments.amount as amount')
        ->join('payments', 'payments.order_id', '=', 'orders.id')
        ->orderBy('status', 'asc')
        ->paginate(10);
    }
}
