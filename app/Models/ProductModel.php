<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WishlistModel;
use Illuminate\Support\Facades\Auth;
use App\Models\imagesModel;
use App\Models\ProductColorModel;

class ProductModel extends Model
{
    use HasFactory;

    public $appends = ['wished'];

    protected $table = 'products';
    protected $filable = [
        'name',
        'description',
        'avatar_pro',
        'category_id',
        'color',
        'quantity',
        'price',
        'promotional_price',
        'status',
        'created_by',
        'created_at',
        'updated_at',
    ];

    static function getProduct()
    {
        return self::select('products.*', 'categories.name as cate_name')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('status', 1)
        ->paginate(8);
    }

    static function getProductByAdmin()
    {
        return self::select('products.*', 'categories.name as cate_name')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->paginate(6);
    }

    static function getProductById($id)
    {
        return self::select('products.*', 'categories.name as cate_name')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('products.id', $id)
        ->get();
    }

    static function getProductByCateID($id)
    {
        return self::select('products.*', 'categories.name as cate_name')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('categories.id', $id)
        ->orWhere('categories.patent_id', $id)
        ->paginate(8);
    }

    static function searchProduct($name)
    {
        return self::select('products.*', 'categories.name as cate_name')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('products.name', 'like', '%' . $name . '%')//tìm kiếm theo tên sản phẩm
        ->orwhere('categories.name', 'like', '%' . $name . '%') // Tìm kiếm theo tên danh mục
        ->orWhereIn('categories.patent_id', function($query) use ($name) {
            $query->select('id')
                ->from('categories')
                ->where('name', $name);
        })
        ->get();
    }

    public function getWishedAttribute()
    {
        if(Auth::check())
        {
            $wished = WishlistModel::where(['product_id' => $this->id, 'user_id' => Auth::user()->id, 'status' => 1])->first();
            return $wished ? true : false;
        }
        else return false;
    }

    public function images()
    {
        return $this->hasMany(imagesModel::class, 'product_id');
    }
    public function product_colors()
    {
        return $this->hasMany(ProductColorModel::class,'product_id');
    }

}
?>