<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use Yajra\DataTables\Contracts\DataTable;
use Str;
use Image;
use File;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('campaigns')->orderBy('id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if($row->status==1){
                        return '<a href="" data-id="'.$row->id .'" class="status_deactive"><i class="fas fa-thumbs-down text-info"><span class="ml-2 badge badge-success">Active</span></i></a>';
                    }else{
                        return '<a href="" data-id="'.$row->id.'" class="status_active"><i class="fas fa-thumbs-up text-danger"><span class="badge badge-success">Deactive</span></i></a>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="#" class="btn btn-info edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal" id="edit"> <i class="fas fa-edit"></i> </a>

                    <a href="' . route('campaign.delete', [$row->id]) . '" class="btn btn-danger" id="delete"> <i class="fas fa-trash"></i>
                    </a>
                    <a href="' . route('campaign.products.all', [$row->id]) . '" class="btn btn-primary"> <i class="fas fa-plus"></i>
                    </a>
                    ';

                    return $actionbtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('admin.offer.campaign.index');
    }
    public function store(Request $request){
        $data = array();
        $data['title'] = $request->campaign_title;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['status'] = $request->status;
        $data['discount'] = $request->discount;
        $slug = Str::slug($request->title, '-');
        //working with image
        $photo=$request->image;
        $photoname = $slug.'.'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(1080,1920)->save('backend/files/campaigns/'.$photoname);

        $data['image'] = 'backend/files/campaigns/'.$photoname;


        DB::table('campaigns')->insert($data);

        $notification = array('message' => 'Campaign Inserted', 'alert-type' => 'success');

        return redirect()->back()->with($notification);

    }

    public function destroy($id){
        $data = DB::table('campaigns')->where('id', $id)->first();
        $image = $data->image;
        if(File::exists($image)){
            unlink($image);
        }
        $data = DB::table('campaigns')->where('id', $id)->delete();
        $notification = array('message' => 'Campaign Deleted', 'alert-type' => 'error');

        return redirect()->back()->with($notification);
    }

    public function edit($id){
        $campaign = DB::table('campaigns')->where('id', $id)->first();
        return view('admin.offer.campaign.edit', compact('campaign'));
    }

    public function update(Request $request){
        $data = array();
        $data['title'] = $request->campaign_title;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['status'] = $request->status;
        $data['discount'] = $request->discount;
        $slug = Str::slug($request->campaign_title, '-');
        if($request->new_image){
            if(File::exists($request->old_image)){
                unlink($request->old_image);
            }
            $photo=$request->new_image;
            $photoname = $slug.'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(468, 90)->save('backend/files/campaigns/'.$photoname);
            $data['image'] = 'backend/files/campaigns/'.$photoname;
            DB::table('campaigns')->where('id', $request->id)->update($data);
            $notification = array('message' => 'Campaign Updated', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
        else{
            $data['image'] = $request->old_image;
            DB::table('campaigns')->where('id', $request->id)->update($data);
            $notification = array('message' => 'Campaign Updated', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }



    //campaign products

    public function campaign_products_index($id){
        $products = DB::table('products')->leftJoin('categories', 'products.category_id', 'categories.id')->leftJoin('brands', 'products.brand_id', 'brands.id')->select('products.*', 'categories.category_name', 'brands.brand_name')->get();
        $campaign = DB::table('campaigns')->where('id', $id)->first();

        return view('admin.offer.campaign.campaign_products.index', compact('products','campaign'));
    }

    public function campaign_products_add($p_id, $c_id){
        $campaign = DB::table('campaigns')->where('id', $c_id)->first();
        $product =  DB::table('products')->where('id', $p_id)->first();

        if($product->discount_price){
            $price = -$product->discount_price/100*($campaign->discount-100);
        }else{
            $price = -$product->selling_price / 100*($campaign->discount-100);
        }

        $data = array(
            'campaign_id' => $campaign->id,
            'product_id' => $product->id,
            'price' => $price
        );

        DB::table('campaigned_products')->insert($data);
        $notification = array('message' => 'Product Inserted', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function campaigned_products_index($id){
        $campaign_products = DB::table('campaigned_products')->leftJoin('products', 'campaigned_products.product_id', 'products.id')->select('products.name','products.code','products.thumbnail','campaigned_products.*')->where('campaigned_products.campaign_id', $id)->get();

        return view('admin.offer.campaign.campaign_products.campaign_products_added', compact('campaign_products'));
    }

    public function campaign_products_delete($id){
        DB::table('campaigned_products')->where('id', $id)->delete();
        $notification = array('message' => 'Product Deleted', 'alert-type' => 'error');
        return redirect()->back()->with($notification);
    }

}

