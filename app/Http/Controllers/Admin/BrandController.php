<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Yajra\DataTables\Contracts\DataTable;
use Str;
use Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('brands')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionbtn = '<a href="#" class="btn btn-info edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" id="edit"> <i class="fas fa-edit"></i> </a>
                    <a href="'.route('childcategory.delete', [$row->id]).'" class="btn btn-danger" id="delete"> <i class="fas fa-trash"></i>
                    </a>';

                    return $actionbtn;
                })
                -> rawColumns(['action'])
                ->make(true);
        }
        return view('admin.category.brand.index');
    }

    public function store(Request $request){

        $validated = $request->validate([
            'brand_name' => 'required|max:55'
        ]);
        $data = array();
        $slug = Str::slug($request->brand_name, '-');

        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = Str::slug($request->brand_name, '-');
        //working with image
            $photo=$request->brand_logo;
        $photoname = $request->$slug.'-'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(240, 120)->save('backend/files/brands/'.$photoname);

        $data['brand_logo'] = 'backend/files/brands/'.$photoname;

        DB::table('brands')->insert($data);

        $notification = array('message' => 'childcategory Inserted', 'alert-type' => 'success');

        return redirect()->back()->with($notification);

    }

}


