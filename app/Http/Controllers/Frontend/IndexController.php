<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Cart;
class IndexController extends Controller
{
    public function index(){
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $reviews = DB::table('reviews')->get();
        $bannerproduct = DB::table('products')->where('product_slider',1)->first();
        $brand = DB::table('brands')->where('id', $bannerproduct->brand_id)->first();
        $settings = DB::table('settings')->first();
        $featured_products = DB::table('products')->where('featured', 1)->limit(10)->get();
        $popular_products = DB::table('products')->where('status', 1)->orderBy('product_views', 'DESC')->limit(16)->get();
        $trendy_products = DB::table('products')->where('status', 1)->where('trendy', '1')->limit(16)->get();
        $homepage_categories = DB::table('categories')->where('homepage_category', 1)->get();
        $suggeted_products = DB::table('products')->inRandomOrder()->limit(12)->get();
        $today_deals_products = DB::table('products')->where('today_deal', 1)->get();
        return view('frontend.index', compact('categories', 'bannerproduct','brand','settings','featured_products','popular_products','trendy_products','brands','homepage_categories','reviews','suggeted_products','today_deals_products'));
    }
    public function product_details($slug){
        $product=DB::table('products')->where('slug', $slug)->first();
                DB::table('products')->where('slug', $slug)->increment('product_views');
        $subcategory = DB::table('subcategories')->where('id', $product->subcategory_id)->first();
        $category = DB::table('categories')->where('id', $subcategory->category_id)->first();
        $brand = DB::table('brands')->where('id', $product->brand_id)->first();
        $pickup_point = DB::table('pickup_points')->where('id', $product->pickup_point_id)->first();
        $related_products = DB::table('products')->where('subcategory_id', $product->subcategory_id)->orderBy('id', 'DESC')->take(10)->get();
        $reviews = DB::table('reviews')->where('product_id', $product->id)->get();
        // dd($related_products);
        return view('frontend.product.product_details', compact('product','category','subcategory','brand','pickup_point','related_products','reviews'));
    }

    public function subscribe(Request $request){
        $email = $request->email;
        $check = DB::table('newsletters')->where('email', $email)->first();

        if($check){
            return response()->json('you have already subscribed using this email!');
        }else{
            $data = array(
                'email' => $email,
            );
            DB::table('newsletters')->insert($data);
            return response()->json('successfully subscribed!');
        }
    }

    public function quick_view($id){
        $product = DB::table('products')->where('id', $id)->first();
        return view('frontend.product.quick_view', compact('product'));
    }
    public function all_cart(){
        $data = array();
        $data['cart_qty'] = Cart::count();
        $data['cart_total'] = Cart::total();
        return response()->json($data);
    }

    public function category_product($id){
        $category = DB::table('categories')->where('id', $id)->first();
        $brands = DB::table('brands')->get();
        $products = DB::table('products')->where('category_id', $category->id)->paginate(6);
        $suggeted_products = DB::table('products')->inRandomOrder()->limit(12)->get();
        return view('frontend.product.category_products', compact('category', 'brands', 'products','suggeted_products'));
    }

    public function subcategory_product($id){
        $subcategory = DB::table('subcategories')->where('id', $id)->first();
        $brands = DB::table('brands')->get();
        $products = DB::table('products')->where('subcategory_id', $subcategory->id)->paginate(6);
        $suggeted_products = DB::table('products')->inRandomOrder()->limit(12)->get();
        return view('frontend.product.subcategory_products', compact('subcategory', 'brands', 'products','suggeted_products'));
    }
    public function childcategory_product($id){
        $childcategory = DB::table('childcategories')->where('id', $id)->first();
        $brands = DB::table('brands')->get();
        $products = DB::table('products')->where('childcategory_id', $childcategory->id)->paginate(6);
        $suggeted_products = DB::table('products')->inRandomOrder()->limit(12)->get();
        return view('frontend.product.childcategory_products', compact('childcategory', 'brands', 'products','suggeted_products'));
    }
}
