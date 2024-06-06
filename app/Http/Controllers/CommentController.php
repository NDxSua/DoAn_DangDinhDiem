<?php

namespace App\Http\Controllers;
use App\Models\CommentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function add(Request $request)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'content' => $request->content,
        ];

        CommentModel::create($data);
        return redirect()->back()->with('success', 'Cảm ơn bạn đã đánh giá sản phẩm!');
    }
}
