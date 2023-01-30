<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Yajra\DataTables\Contracts\DataTable;
use Str;
use Image;
use File;
class BlogCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function category_index(Request $request){
        if($request->ajax()){
            $data = DB::table('blog_category')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionbtn = '<a href="#" class="btn btn-info edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" id="edit"> <i class="fas fa-edit"></i> </a>
                    <a href="'.route('brand.delete', [$row->id]).'" class="btn btn-danger" id="delete"> <i class="fas fa-trash"></i>
                    </a>';

                    return $actionbtn;
                })
                -> rawColumns(['action'])
                ->make(true);
        }
        return view('admin.blog.category.index');
    }

    public function category_store(Request $request){

        $data = array();

        $data['category_name'] = $request->category_name;
        $data['category_slug'] = Str::slug($request->category_name, '-');

        DB::table('blog_category')->insert($data);

        
        $notification = array('message' => 'Blog Category Inserted', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function category_edit($id){
        $category = DB::table('blog_category')->where('id', $id)->first();
        return view('admin.blog.category.edit', compact('category'));
    }

    public function category_update(Request $request){
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = Str::slug($request->category_name, '-');

        DB::table('blog_category')->where('id', $request->id)->update($data);
        
        $notification = array('message' => 'Blog Category Updated', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }



}
