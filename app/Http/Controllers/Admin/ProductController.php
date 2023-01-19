<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use DB;
use Str;
use Auth;
use Image;
use DataTables;
use App\Models\Product;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        if ($request->ajax()) {
            $product = "";
            $query = DB::table('products')->leftJoin('categories', 'products.category_id', 'categories.id')
                ->leftJoin('subcategories', 'products.subcategory_id', 'subcategories.id')
                ->leftJoin('brands', 'products.brand_id', 'brands.id');
                if($request->category_id){
                    $query->where('products.category_id', $request->category_id);
                }
                if($request->brand_id){
                    $query->where('products.brand_id', $request->brand_id);
                }
                if($request->warehouse){
                    $query->where('products.warehouse', $request->warehouse);
                }
                if($request->status==1){
                    $query->where('products.status', 1);
                }
                if($request->status==0){
                    $query->where('products.status', 0);
                }
            $product = $query->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')->get();
            return DataTables::of($product)
                ->addIndexColumn()
                ->editColumn('thumbnail', function ($row) {
                    return '<img src="' . $row->thumbnail . '" height="50" width:"30">';
                })
                ->editColumn('featured', function ($row) {
                    if($row->featured==1){
                        return '<a href="" data-id="'.$row->id .'" class="deactive_featured"><i class="fas fa-thumbs-down text-info"><span class="ml-2 badge badge-success">Active</span></i></a>';
                    }else{
                        return '<a href="" data-id="'.$row->id .'" class="active_featured"><i class="fas fa-thumbs-up text-danger"><span class="badge badge-success ml-2">Deactive</span></i></a>';
                    }
                })
                ->editColumn('today_deal', function ($row) {
                    if($row->today_deal==1){
                        return '<a href="" data-id="'.$row->id .'" class="today_deal_deactive"><i class="fas fa-thumbs-down text-info"><span class="ml-2 badge badge-success">Active</span></i></a>';
                    }else{
                        return '<a href="" data-id="'.$row->id .'" class="today_deal_active"><i class="fas fa-thumbs-up text-danger"><span class="badge badge-success">Deactive</span></i></a>';
                    }
                })
                ->editColumn('status', function ($row) {
                    if($row->status==1){
                        return '<a href="" data-id="'.$row->id .'" class="status_deactive"><i class="fas fa-thumbs-down text-info"><span class="ml-2 badge badge-success">Active</span></i></a>';
                    }else{
                        return '<a href="" data-id="'.$row->id.'" class="status_active"><i class="fas fa-thumbs-up text-danger"><span class="badge badge-success">Deactive</span></i></a>';
                    }
                })
                ->addColumn('action', function($row) {
                    $actionbtn = '<a href="'.route('product.edit', [$row->id]).'" class="btn btn-info" data-id="'.$row->id .'"  id="edit"> <i class="fas fa-edit"></i> </a>
                    <a href="'.route('pickup_point.delete', [$row->id]).'" class="btn btn-warning" id="delete"> <i class="fas fa-eye"></i>
                    </a>
                    <a href="'.route('product.delete', [$row->id]).'" class="btn btn-danger" id="delete"> <i class="fas fa-trash"></i>
                    </a>';
                    return $actionbtn;
                })
                ->rawColumns(['action','thumbnail','category_name','subcategory_name','brand_name','featured','today_deal','status'])
                ->make(true);
        }
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $warehouses = DB::table('warehouses')->get();
        $pickup_points = DB::table('pickup_points')->get();
        return view('admin.product.index', compact('categories','brands','warehouses'));
    }

    public function create(){
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $pickup_points = DB::table('pickup_points')->get();
        $childcategories = DB::table('childcategories')->get();
        $warehouses = DB::table('warehouses')->get();
        return view('admin.product.new product.index' , compact('categories', 'brands', 'pickup_points', 'childcategories','warehouses'));
    }

    public function store(Request $request){
        // $validated = $request->validate([
        //     'name' => 'required',
        //     'code' => 'required|unique:products|max:55',
        //     'subcategory_id' => 'required',
        //     'brand_id' => 'required',
        //     'unit' => 'required',
        //     'selling_price' => 'required',
        //     'color' => 'required',
        //     'description' => 'required',
        // ]);
        $subcategory = DB::table('subcategories')->where('id', $request->subcategory_id)->first();

        $data = array();

        $data['category_id'] = $subcategory->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['childcategory_id'] = $request->childcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name, '-');
        $data['code'] = $request->code;
        $data['pickup_point_id'] = $request->pickup_point_id;
        $data['purchase_price'] = $request->purchase_price;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['unit'] = $request->unit;
        $data['tags'] = $request->tags;
        $data['warehouse'] = $request->warehouse;
        $data['stock_quantity'] = $request->stock;
        $data['color'] = $request->color;
        $data['size'] = $request->size;
        $data['description'] = $request->color;
        $data['video'] = $request->video;
        $data['featured'] = $request->featured;
        $data['today_deal'] = $request->today_deal;
        $data['product_slider'] = $request->product_slider;
        $data['trendy'] = $request->trendy;
        $data['status'] = $request->status;
        $data['admin_id'] = Auth::id();
        $data['date'] = date('d-m-y');
        $data['month'] = date('f');

        //thumbnail image
        if($request->main_thumbnail){
            $slug = Str::slug($request->name, '-');
            $photo = $request->main_thumbnail;
            $photoname = $slug . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(600,600)->save('backend/files/products/product_thumbnails/'.$photoname);

            $data['thumbnail'] = 'backend/files/products/product_thumbnails/'.$photoname;
        }
        //multiple images
        $images = array();
        if($request->hasFile('images')){
            foreach($request->file('images') as $key => $image){
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(600, 600)->save('backend/files/products/' . $image_name);
                array_push($images, $image_name);
            }
            $data['images'] = json_encode($images);
        }
        DB::table('products')->insert($data);
        $notification = array('message' => 'Product Inserted', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    //edit product
    public function edit($id){
        $product = DB::table('products')->where('id', $id)->first();
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $warehouses = DB::table('warehouses')->get();
        $brands = DB::table('brands')->get();
        $pickup_points = DB::table('pickup_points')->get();
        return view('admin.product.new product.edit', compact('product','categories', 'brands', 'warehouses', 'brands','pickup_points',));
    }

    //delete product
    public function destroy($id){
        DB::table('products')->where('id', $id)->delete();
        return response()->json('product has been deleted successfully');
    }



    //deactive featured
    public function deactive_featured($id){
            DB::table('products')->where('id', $id)->update(['featured'=>0]);
            return response()->json('product not featured!');
    }
    //active featured
    public function active_featured($id){
            DB::table('products')->where('id', $id)->update(['featured'=>1]);
            return response()->json('product is featured!');
    }
    //today_deal_deactive
    public function today_deal_deactive($id){
            DB::table('products')->where('id', $id)->update(['today_deal'=>0]);
            return response()->json('today deal is deactive');
    }
    //today_deal_active
    public function today_deal_active($id){
            DB::table('products')->where('id', $id)->update(['today_deal'=>1]);
            return response()->json('today deal is active');
    }
    //status_deactive
    public function status_deactive($id){
            DB::table('products')->where('id', $id)->update(['status'=>0]);
            return response()->json('status is deactive');
    }
    //status_active
    public function status_active($id){
            DB::table('products')->where('id', $id)->update(['status'=>1]);
            return response()->json('status is active');
    }
}
