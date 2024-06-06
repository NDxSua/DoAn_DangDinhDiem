<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\CartModel;
use App\Models\Order_detailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderDetailModel;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Support\Facades\DB;
use App\Models\PaymentModel;
use App\Models\ProductModel;

class CheckoutController extends Controller
{
    public function index()
    {
        $data = [
            'header_title' => 'Thanh toán',
        ];

        return view('frontend.components.checkout', $data);
    }
    
    public function checkout(Request $request, $payment_method)
    {
        $radio_checked = $request->input('radio');

        if($radio_checked === 'normal')
        {
            $delivery = 1;
        }
        else if($radio_checked === 'fast')
        {
            $delivery = 2;
        }
        $data = [
            'user_id' => $request->user_id,
            'fullname' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'province' => $request->province,
            'district' => $request->district,
            'street_address' => $request->street_address,
            'note' => $request->note,
            'total' =>$request->total_price,
            'delivery_id' => $delivery,
            'payment_id' => $payment_method,
        ];

        $order = OrderModel::create($data);

        foreach(Auth::user()->carts as $val)
            {
                $data1 = [
                    'order_id' => $order->id,
                    'product_id' => $val->product_id,
                    'quantity' => $val->quantity,
                    'price' => $val->money,
                ];

                OrderDetailModel::create($data1);
            }
        $payment = new PaymentModel();
        $payment->order_id = $order->id;
        $payment->payment_method = $payment_method;
        $payment->amount = $request->total_price;
        $payment->save();
        DB::commit();
        return $payment->id;
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function post_checkout(Request $request)
    {
        if(isset($_POST['paymentMethod']))
        {
            $paymentMethod = $_POST['paymentMethod'];
            if($paymentMethod == 'cod')
            {
                $this->checkout($request, 1);
                $sql = CartModel::where(['user_id' => Auth::user()->id]);
                $cart = $sql->get();
                foreach($cart as $val)
                {
                    $product = ProductModel::find($val->product_id);
                    $product->quantity = $product->quantity - $val->quantity;
                    $product->save();
                }
                $sql->delete();
                return redirect()->route('profile.index')->with('success', 'Đặt hàng thành công');
            }
            else if($paymentMethod == 'payUrl')
            {
                $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
                $partnerCode = 'MOMOBKUN20180529';
                $accessKey = 'klm05TvNBzhg7h7j';
                $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
    
                $orderInfo = "Thanh toán qua MoMo";
                $amount = $request->total_price;
                $orderId = time() . "";
                $redirectUrl = route('paymentOnline');
                $ipnUrl = route('home');
                
                $extraData = "";
                $partnerCode = $partnerCode;
                $accessKey = $accessKey;
                $serectkey = $secretKey;
                $orderId = $orderId; // Mã đơn hàng
                $orderInfo = $orderInfo;
                $amount = $amount;
                $ipnUrl = $ipnUrl;
                $redirectUrl = $redirectUrl;
                $extraData = $this->checkout($request, 2, 0);
    
                $requestId = time() . "";
                $requestType = "payWithATM";
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                $signature = hash_hmac("sha256", $rawHash, $serectkey);
                $data = array(
                    'partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    "storeId" => "MomoTestStore",
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature
                );
                
                $result = $this->execPostRequest($endpoint, json_encode($data));
                $jsonResult = json_decode($result, true); 
                 return redirect()->to( $jsonResult['payUrl'])->send();
            }
        }
    }

    public function paymentOnline(Request $request) {
        $payment = PaymentModel::find($request->extraData);
        if($request->vnp_ResponseCode == '00' || $request->message == 'Successful.'){
            $sql = CartModel::where(['user_id' => Auth::user()->id]);
            $cart = $sql->get();
            foreach($cart as $val)
            {
                $product = ProductModel::find($val->product_id);
                $product->quantity = $product->quantity - $val->quantity;
                $product->save();
            }
            $sql->delete();
            $payment->status = 1;
            $payment->save();
            return redirect()->route('profile.index')->with('success', 'Đặt hàng thành công');
        }
        else {
            $order = OrderModel::where('id', $payment->order_id)->first();
            $order->order_detail()->delete();
            $order->payments()->delete();
            $order->delete();
            return redirect()->route('profile.index')->with('error', 'Xảy ra lỗi khi đặt hàng');
        }
    }

    public function delete($id)
    {
        $order = OrderModel::find($id);
        $order->delete();
        return redirect()->back()->with('success', "Hủy đơn hàng thành công!");
    }
}
