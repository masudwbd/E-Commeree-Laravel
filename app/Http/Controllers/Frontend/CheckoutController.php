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
        if($request->payment_type=="Hand Cash"){
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
        elseif($request->payment_type=="Aamarpay"){
            $aamarpay = DB::table('payment_gateway_bd')->first();
            if($aamarpay->store_id==null){
                $notification = array('message' => 'Please complete the settings of your gateway', 'alert-type' => 'error');
                return redirect()->back()->with($notification);
            }else{
                if($aamarpay->status==1){
                    $url = 'https://secure.aamarpay.com/request.php'; // live url https://secure.aamarpay.com/request.php
                }else{
                    $url = 'https://sandbox.aamarpay.com/request.php';
                }
                $fields = array(
                    'store_id' => $aamarpay->store_id, //store id will be aamarpay,  contact integration@aamarpay.com for test/live id
                    'amount' => Cart::total(), //transaction amount
                    'payment_type' => 'VISA', //no need to change
                    'currency' => 'BDT',  //currenct will be USD/BDT
                    'tran_id' => rand(1111111,9999999), //transaction id must be unique from your end
                    'cus_name' => $request->c_name,  //customer name
                    'cus_email' => $request->c_email, //customer email address
                    'cus_add1' => $request->c_address,  //customer address
                    'cus_add2' => 'Mohakhali DOHS', //customer address
                    'cus_city' => $request->c_city,  //customer city
                    'cus_state' => 'Dhaka',  //state
                    'cus_postcode' => $request->c_zipcode, //postcode or zipcode
                    'cus_country' => $request->c_country,  //country
                    'cus_phone' => $request->c_phone, //customer phone number
                    'cus_fax' => $request->c_extra_phone,  //fax
                    'ship_name' => 'ship name', //ship name
                    'ship_add1' => 'House B-121, Road 21',  //ship address
                    'ship_add2' => 'Mohakhali',
                    'ship_city' => 'Dhaka', 
                    'ship_state' => 'Dhaka',
                    'ship_postcode' => '1212', 
                    'ship_country' => 'Bangladesh',
                    'desc' => 'payment description', 
                    'success_url' => route('success'), //your success route
                    'fail_url' => route('fail'), //your fail route
                    'cancel_url' => route('fail'), //your cancel url
                    'opt_a' => $request->c_country,  //subtotal
                    'opt_b' => $request->c_city, //payment_type
                    'opt_c' => $request->c_phone,  //customer phone
                    'opt_d' => $request->c_address,
                    'signature_key' => $aamarpay->signature_id); //signature key will provided aamarpay, contact integration@aamarpay.com for test/live signature key
    
                    $fields_string = http_build_query($fields);
             
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_VERBOSE, true);
                curl_setopt($ch, CURLOPT_URL, $url);  
          
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));	
                curl_close($ch); 
    
                $this->redirect_to_merchant($url_forward);
            }
        }
    }

    function redirect_to_merchant($url) {

        ?>
        <html xmlns="http://www.w3.org/1999/xhtml">
          <head><script type="text/javascript">
            function closethisasap() { document.forms["redirectpost"].submit(); } 
          </script></head>
          <body onLoad="closethisasap();">
          
            <form name="redirectpost" method="post" action="<?php echo 'https://sandbox.aamarpay.com/'.$url; ?>"></form>
            <!-- for live url https://secure.aamarpay.com -->
          </body>
        </html>
        <?php	
        exit;
    } 

    
    public function success(Request $request){
        $order=array();
        $order['user_id']=Auth::id();
        $order['c_name']=$request->cus_name;
        $order['c_phone']=$request->opt_c;
        $order['c_country']=$request->opt_a;
        $order['c_address']=$request->opt_d;
        $order['c_email']=$request->cus_email;
        $order['c_city']=$request->opt_b;
        if(Sessio()->has('coupon')){
            $order['subtotal']=Cart::subtotal();
            $order['coupon_code']=Sessio()->get('coupon')['name'];
            $order['coupon_discount']=Session()->get('coupon')['after_discount'];
        }else{
            $order['subtotal']=Cart::subtotal();
            
        }
        $order['total']=Cart::total();
        $order['payment_type']='Aamarpay';
        $order['tax']=0;
        $order['shipping_charge']=0;
        $order['order_id']=rand(10000,900000);
        $order['status']=1;
        $order['date']=date('d-m-Y');
        $order['month']=date('F');
        $order['year']=date('Y');

        $order_id=DB::table('orders')->insertGetId($order);


        Mail::to(Auth::user()->email)->send(new InvoiceMail($order));

        //order details
        $content=Cart::content();

        $details=array();
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
        if (Session()->has('coupon')) {
              Session()->forget('coupon');
        }
        $notification=array('messege' => 'Successfullt Order Placed!', 'alert-type' => 'success');
        return redirect()->route('home')->with($notification);
    }

    public function fail(Request $request){
        return $request;
    }
}
