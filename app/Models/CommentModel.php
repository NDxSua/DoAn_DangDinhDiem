<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'content',
    ];

    static function getCommentByID($id)
    {
        return self::select('comments.content', 'users.name as user_name', 'comments.created_at as date')
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->where('product_id', $id)
        ->orderByDesc('comments.id')
        ->get();
    }
}
