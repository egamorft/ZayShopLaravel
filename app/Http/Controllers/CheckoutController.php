<?php

namespace App\Http\Controllers;

use App\Account;
use App\Address;
use App\City;
use App\Coupon;
use App\Feeship;
use App\Order;
use App\OrderDetails;
use App\Province;
use App\Shipping;
use App\Wards;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function check_out()
    {
        $account_id = Session::get('account_id');
        if (isset($_GET['resultCode'])) {
            if ($_GET['resultCode'] == 1006) {
                Session::put('error', 'You just cancel your MOMO payment');
                return Redirect::to('/check-out');
            } elseif (($_GET['resultCode'] == 0)) {
                $signature = $_GET['signature'];
                Session::put('signature', $signature);
                return Redirect::to('/check-out');
            } else {
                Session::put('error', 'Something went wrong, please try another payment gate');
                return Redirect::to('/check-out');
            }
        }
        $content = Cart::content();
        $i = 0;
        foreach ($content as $item) {
            if ($item->options->in_stock < $item->qty) {
                $i++;
                Session::put('error', 'Quantity in stock is not enough');
                return back();
            }
        }
        $city = City::orderby('matp', 'asc')->get();
        $address = Address::where('account_id', $account_id)->with('city_address')->with('province_address')->with('ward_address')->orderBy('is_default', 'desc')->first();
        if($address){
            $city = $address->city;
            $province = $address->province;
            $ward = $address->ward;
            $feeship = Feeship::where('fee_matp', $city)
                    ->where('fee_maqh', $province)
                    ->where('fee_xaid', $ward)->first();
            if ($feeship) {
                if(Session::get('fee')){
                    Session::forget('fee');
                }
                Session::put('fee', $feeship->fee_feeship);
                Session::save();
            } else {
                if(Session::get('fee')){
                    Session::forget('fee');
                }
                Session::put('fee', 50000);
                Session::save();
            }
        }
        $address_list = Address::where('account_id', $account_id)->with('city_address')->with('province_address')->with('ward_address')->orderBy('is_default', 'desc')->get();
        return view('pages.checkout.shop_checkout')->with(compact('city', 'address', 'address_list'));
    }

    public function confirm_order(Request $request)
    {
        $account_id = Session::get('account_id');

        $data = $request->all();
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_specific_address = $data['shipping_address'];
        $shipping->shipping_city = $data['shipping_city'];
        $shipping->shipping_province = $data['shipping_province'];
        $shipping->shipping_ward = $data['shipping_ward'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['payment_select'];
        $shipping->save();

        $checkout_code = substr(md5(microtime()), rand(0, 26), 5);
        $shipping_id = $shipping->shipping_id;

        $order = new Order();
        $order->account_id = $account_id;
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = strtoupper($checkout_code);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = now();
        $order->save();

        if (Session::get('coupon')) {
            $coupon = Coupon::where('coupon_code', Session::get('coupon'))->first();
            $coupon->coupon_time = $coupon->coupon_time - 1;
            $coupon->update();
        }

        if (Cart::count() != 0) {
            foreach (Cart::content() as $key => $cart) {
                $order_details = new OrderDetails();
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart->id;
                $order_details->product_name = $cart->name;
                $order_details->product_price = $cart->price;
                $order_details->product_sales_quantity = $cart->qty;
                $order_details->product_coupon = $data['order_coupon'];
                $order_details->product_feeship = $data['order_fee'];
                $order_details->save();
            }

            Cart::destroy();
            Session::forget('coupon');
            Session::forget('signature');
        }
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

    public function momo_payment(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $request->total_momo;
        $orderId = time() . "";
        $redirectUrl = "http://localhost/shopZay/check-out";
        // $ipnUrl = "http://localhost/shopZay/check-out";
        $ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
        $extraData = "";

        $requestId = time() . "";
        $requestType = "captureWallet";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey
            . "&amount=" . $amount
            . "&extraData=" . $extraData
            . "&ipnUrl=" . $ipnUrl
            . "&orderId=" . $orderId
            . "&orderInfo=" . $orderInfo
            . "&partnerCode=" . $partnerCode
            . "&redirectUrl=" . $redirectUrl
            . "&requestId=" . $requestId
            . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "EgamorftStore",
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
        $jsonResult = json_decode($result, true);  // decode json
        //Just a example, please check more in there
        // dd($jsonResult);
        return $jsonResult['payUrl'];
    }
}
