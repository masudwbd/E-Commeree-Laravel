<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Cart;
use Auth;
use DB;
class CartController extends Controller
{
    public function add_to_cart_qv(Request $request){
        // $product = Product::where('id', $request->id)->first();
        $product = Product::find($request->id);

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => '1',
            'options' => ['size' => $request->size, 'color' => $request->color, 'thumbnail' => $product->thumbnail],
        ]);
        return response()->json('Added To Cart!');
    }

    public function MyCart(){
        $content = Cart::content();
        return view('frontend.cart.cart', compact('content'));
    }
    public function DestroyCart(){
        Cart::destroy();
        $notification = array('message' => 'Your Cart Is Now Empty!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function RemoveProduct($rowId){
        Cart::remove($rowId);
        return response()->json('success');
    }
    public function UpdateQty($rowId , $qty){
        Cart::update($rowId, ['qty' => $qty]);
        return response()->json('quantity updated');
    }

    public function UpdateColor($rowId, $color){
        $product = Cart::get($rowId);
        $thumbnail = $product->options->thumbnail;
        $size = $product->options->size;
        Cart::update($rowId , ['options' => ['color' => $color, 'thumbnail'=>$thumbnail, 'size'=>$size]]);
        return response()->json('color updated');
    }

    public function UpdateSize($rowId, $size){
        $product = Cart::get($rowId);
        $thumbnail = $product->options->thumbnail;
        $color = $product->options->color;
        Cart::update($rowId , ['options' => ['color' => $color, 'thumbnail'=>$thumbnail, 'size'=>$size]]);
        return response()->json('size updated');
    }

    public function wishlist_show(){
        if(Auth::check()){
            $wishlist = DB::table('wishlist')->leftjoin('products', 'wishlist.product_id', 'products.id')->select('products.name', 'products.thumbnail', 'wishlist.*')->where('wishlist.user_id', Auth::id())->get();

            return view('frontend.cart.wishlist', compact('wishlist'));
            
        }
        $notification = array('message' => 'Please Login To See Your Wishlist', 'alert-type' => 'error');
        return redirect()->back()->with($notification);
    }

    public function wishlist_product_remove($id){
        DB::table('wishlist')->where('id', $id)->delete();
        $notification = array('message' => 'Successfully removed', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function wishlist_remove(){
        DB::table('wishlist')->where('user_id', Auth::id())->delete();
        $notification = array('message' => 'Wishlist Cleared!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
