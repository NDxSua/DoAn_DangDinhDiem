<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class CartModel extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'money',
    ];
    static function getAll()
    {
        if(Auth::check())
        {
            return self::select('carts.*','products.name as product_name', 'products.avatar_pro as avt_pro', 'products.price as normal_price', 'products.promotional_price as sale_price', 'products.color as color')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->where('user_id', Auth::user()->id)
            ->get();
        }
        else return [];
    }

    static public function total() {
        if(Auth::check())
        {
            return self::where('user_id', Auth::user()->id)->sum('money');
        }
        else return 0;
    }
}
?>