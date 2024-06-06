<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductColorModel;


class ColorModel extends Model
{
    use HasFactory;

    protected $table = 'colors';
    protected $fillable = [
        'name',
    ];

    public function product_color()
    {
        return $this->hasMany(ProductColorModel::class, 'color_id');
    }
}
