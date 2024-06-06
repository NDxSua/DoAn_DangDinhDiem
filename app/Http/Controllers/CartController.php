<?php
namespace App\Http\Controllers;
use App\Models\ProductModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CartModel;
use App\Models\DeliveryModel;

class   CartController extends Controller
{
    public function index ()
    {
        $data = [
            'header_title' => 'Giỏ hàng',
            'delivery' => DeliveryModel::all(),
            'up_total' => 0,
                 
        ];
        return view('frontend.components.cart', $data);
    }

    public function add(Request $request)
    {
        $user_id = Auth::user()->id;
        $quantity = $request -> quantity ? $request -> quantity : 1;

        $product = ProductModel::where(['id' => $request->product_id])->first();

        if($quantity > $product->quantity)
        {
            return redirect()->back()->with('error', 'Số lượng yêu cầu vượt quá số lượng hiện có');
        }
        else
        {
            $cartExists = CartModel::where(['user_id' => $user_id, 'product_id' => $request->product_id])->first();
            if($cartExists)
            {
                if($cartExists->quantity == $product->quantity)
                {
                    return redirect()->back()->with('error', 'Số lượng yêu cầu vượt quá số lượng hiện có');
                }
                else
                {
                    CartModel::where(['user_id' => $user_id, 'product_id' => $request->product_id])->increment('quantity', $quantity);
                    return redirect()->back()->with('success', 'Cập nhật sản phẩm trong giỏ hàng thành công');
                }
            }
            if($product->promotional_price == null)
            {
                $money = $product->price * $quantity;
            }
            else
            {
                $money = $product->promotional_price * $quantity;
            }
    
            $data = [
                'user_id' => $user_id,
                'product_id' => $request->product_id,
                'quantity' => $quantity,
                'money' => $money,
            ];
    
            if(CartModel::create($data))
            {
                return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công!');
            }
    
            else return redirect()->back()->with('error', 'Thêm sản phẩm vào giỏ hàng thất bại');
        }
    }

    public function update(Request $request)
    {
        $id = $request->id_cart;
        $quantity = $request->quantity;
        $money = $request->money;

        CartModel::where(['id' => $id])->update(['quantity' => $quantity, 'money' => $money]);
        return redirect()->back()->with('success', "Cập nhật giỏ hàng thành công!");
    }

    public function delete($id)
    {
        $cart = CartModel::find($id);
        $cart->delete();
        return redirect()->back()->with('success', "Xóa sản phẩm khỏi giỏ hàng thành công!");
    }

}
?>