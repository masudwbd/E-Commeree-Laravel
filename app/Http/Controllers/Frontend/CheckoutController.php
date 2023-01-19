<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Cart;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\invoiceMail;
use Symfony\Component\HttpFoundation\Session\Session;
class CheckoutController extends Controller
{
    public function checkout(){
        return view('frontend.cart.checkout');
    }

    public function coupon_apply(Request $request){
        $coupon = DB::table('coupons')->where('coupon_code', $request->coupon_code)->first();

        if($coupon){
            if(date('Y-m-d', strtotime(date('Y-m-d'))) <= date('Y-m-d', strtotime($coupon->valid_date))){
                session()->put('coupon', [
                    'name' => $coupon->coupon_code,
                    'discount' => $coupon->coupon_amount,
                    'discount_total' => Cart::subtotal() - $coupon->coupon_amount
                ]);
                $notification = array('message' => 'Coupon Applied!', 'alert-type' => 'success');
                return redirect()->back()->with($notification);
            }else{
                $notification = array('message' => 'Date Expired!', 'alert-type' => 'error');
                return redirect()->back()->with($notification);
            }
        }
        else{
            $notification = array('message' => 'Coupon Was Not Found', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }

    public function coupon_remove(){
        session()->forget('coupon');
        $notification = array('message' => 'Coupon Was removed!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    public function order_place(Request $request){
        $order = array(
            'user_id' => Auth::id(),
            'c_name' => $request->c_name,
            'c_phone' => $request->c_phone,
            'c_country' => $request->c_country,
            'c_address' => $request->c_address,
            'c_email' => $request->c_email,
            'c_zipcode' => $request->c_zipcode,
            'c_extra_phone' => $request->c_extra_phone,
            'c_city' => $request->c_city,
        );

        if(session()->has('coupon')){
            $order['subtotal'] = Cart::subtotal();
            $order['total'] = Cart::total();
            $order['coupon_code'] = session()->get('coupon')['name'];
            $order['coupon_discount'] = session()->get('coupon')['discount'];
            $order['after_discount'] = session()->get('coupon')['discount_total'];
        }else{
            $order['subtotal'] = Cart::subtotal();
            $order['total'] = Cart::total();
        }
        $order['payment_type'] = $request->payment_type;
        $order['tax'] = 0;
        $order['shipping_charge'] = 0;
        $order['order_id'] = rand(10000, 900000);
        $order['status'] = 0;
        $order['date'] = date('d-m-Y');
        $order['month'] = date('F');
        $order['year'] = date('Y');

        $order_id = DB::table('orders')->insertGetId($order);

        //sending mail
        // Mail::to($request->c_email)->send(new( invoiceMail($order)));

        $content = Cart::content();

        $details = array();

        foreach($content as $row){
            $details['order_id']=$order_id;
            $details['product_id']=$row->id;
            $details['product_name']=$row->name;
            $details['color']=$row->options->color;
            $details['size']=$row->options->size;
            $details['quantity']=$row->qty;
            $details['single_price']=$row->price;
            $details['subtotal_price']=$row->price*$row->qty;
            DB::table('order_details')->insert($details);
        }
        Cart::destroy();

        if(session()->has('coupon')){
            session()->forget('coupon');
        }
        $notification = array('message' => 'Your Order Was Successfully Placed!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
