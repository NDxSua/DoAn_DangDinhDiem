<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class WishlistModel extends Model
{
    use HasFactory;

    protected $table = 'wishlists';
    protected $fillable = [
        'product_id',
        'user_id',
        'status',
    ];

    static function getAll()
    {
        if(Auth::check())
        {
            return self::select('wishlists.*', 'products.name as product_name', 'products.avatar_pro as avt_pro', 'products.price as normal_price', 'products.promotional_price as sale_price')
            ->join('products', 'wishlists.product_id', '=', 'products.id')
            ->where('user_id', Auth::user()->id)
            ->where('wishlists.status', 1)
            ->get();
        }
        else return [];
    }
}
?>