<?php
namespace App\Http\Controllers;
use App\Models\ProductModel;
use App\Models\WishlistModel;
use Illuminate\Support\Facades\Auth;

class   WishlistController extends Controller
{
    public function index()
    {
        $data = 
        [
            'header_title' => 'Yêu thích',
            'wish' => WishlistModel::getAll(),
        ];

        return view('frontend.components.wishlist', $data);

    }

    public function add($product)
    {
        $user_id = Auth::user()->id;
        
        $data = 
        [
            'user_id' => $user_id,
            'product_id' => $product,
        ];

        $wished = WishlistModel::where(['product_id' => $product, 'user_id' => $user_id])->first();
        if($wished)
        {
            if($wished->status == 1)
            {
                $wished->update(['status' => 0]);
                return redirect()->back()->with('success', 'Bỏ thích sản phẩm thành công.');
            }
            else
            {
                $wished->update(['status' => 1]);
                return redirect()->back()->with('success', 'Yêu thích sản phẩm thành công.');
            }

        }
        else
        {
            WishlistModel::create($data);
            return redirect()->back()->with('success', 'Yêu thích sản phẩm thành công.');
        }
    }
}
?>