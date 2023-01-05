<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use DB;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $data = DB::table('categories')->get();
        return view('admin.category.category.index',compact('data'));
    }

    public function store(Request $request){
        

        // Eloquent ORM
        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name,'-'),
        ]);

        $notification = array('message' => 'Category Inserted','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function edit($id){
        // $data=DB::table('categories')->where('id',$id)->first();
        $data = Category::findorfail($id);
        return response()->json($data);
    }

    public function update(Request $request){
        $category = Category::where('id',$request->id)->first();
        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name, '-')
        ]);

        $notification = array('message' => 'Category Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function delete($id){
        $category = Category::find($id);
        $category->delete();

        $notification = array('message' => 'Category Deleted','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function GetChildCategory($id){
        $data = DB::table('childcategories')->where('subcategory_id', $id)->get();
        return response($data);
    }
}
