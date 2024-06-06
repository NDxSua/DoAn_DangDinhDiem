<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Laravel\Prompts\select;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'patent_id',
        'created_by',
    ];

    static function getCateByProductID($id)
    {
        return self::select('categories.*')
        ->join('products', 'categories.id', '=', 'products.category_id')
        ->where('products.id', $id)
        ->get();
    }
}
?>