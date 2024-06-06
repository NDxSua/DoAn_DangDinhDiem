<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_attribute extends Model
{
    use HasFactory;

    protected $table = 'product_attributes';
    protected $fillable = [
        'product_id',
        'attribute_id',
    ];

    static function getAttbyProductID($id)
    {
        return self::select('attributes.name as att_name', 'product_attributes.value as att_value')
        ->join('products', 'product_attributes.product_id', '=', 'products.id')
        ->join('attributes', 'product_attributes.attribute_id', '=', 'attributes.id')
        ->where('product_attributes.product_id', $id)
        ->get();
    }
}
?>