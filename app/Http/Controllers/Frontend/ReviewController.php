<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class ReviewController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'review' => 'required',
            'rating' => 'required'
        ]);

        $check = DB::table('reviews')->where('user_id', Auth::id())->where('product_id', $request->product_id)->first();
        if($check){
            $notification = array('message' => 'You Already Have Given A Review Of This Product', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        $data = array();
        $data['user_id'] = Auth::id();
        $data['product_id'] = $request->product_id;
        $data['review'] = $request->review;
        $data['rating'] = $request->rating;
        $data['review_date'] = date('d-m-y');
        $data['review_month'] = date('F');
        $data['review_month'] = date('Y');

        DB::table('reviews')->insert($data);

        $notification = array('message' => 'Thank you for your review', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function website_review_store(Request $request){
        $validated = $request->validate([
            'review' => 'required',
            'rating' => 'required'
        ]);

        $check = DB::table('reviews')->where('user_id', Auth::id())->where('product_id', $request->product_id)->first();
        if($check){
            $notification = array('message' => 'You Already Have Given A Review Of This Product', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        $data = array();
        $data['user_id'] = Auth::id();
        $data['name'] = $request->name;
        $data['review'] = $request->review;
        $data['rating'] = $request->rating;
        $data['review_date'] = date('d-m-y');
        $data['review_month'] = date('F');
        $data['review_month'] = date('Y');

        DB::table('websitereviews')->insert($data);

        $notification = array('message' => 'Thank you for your review', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function wishlist_add($product_id){
        $check = DB::table('wishlist')->where('user_id', Auth::id())->where('product_id', $product_id)->first();
        if($check){
            $notification = array('message' => 'You have already added this product to your wishlist', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
        $data = array();
        $data['user_id'] = Auth::id();
        $data['product_id'] = $product_id;
        $data['date'] = date('Y-m-d H:i:s');

        DB::table('wishlist')->insert($data);
        $notification = array('message' => 'You have added this product to your wishlist', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
