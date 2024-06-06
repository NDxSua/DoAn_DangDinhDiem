<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColorModel extends Model
{
    use HasFactory;

    protected $table = 'product_colors';
    protected $fillable = [
        'product_id',
        'color_id',
    ];

    static function getByProductID($id)
    {
        return self::select('product_colors.color_id')
        ->where('product_id', $id)
        ->get();
    }
}
