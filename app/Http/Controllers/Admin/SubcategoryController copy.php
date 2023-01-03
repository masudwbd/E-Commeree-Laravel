<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subcategory;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // index method

    public function index(){
        // $data = DB::table('subcategories')->leftJoin('categories','subcategories.category_id','categories.id')
        //     ->select('subcategories.*','categories.category_name')->get();

        $data = Subcategory::all();
        $category = Category::all();
        return view('admin.category.subcategory.index',compact('data','category'));
    }

    // store method

    public function store(Request $request){
        $validated = $request->validate([
            'subcategory_name' => 'required|max:55'
        ]);

        // Query Builder

        // $data = array();
        // $data['category_id'] = $request-> category_id;
        // $data['subcategory_name'] = $request-> subcategory_name;
        // $data['subcat_slug'] = Str::slug($request->subcategory_name,'-');
        // DB::table('subcategories')->insert($data);

        // eloquent ORM

        Subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcat_slug' => Str::slug($request->subcategory_name,'-'),
        ]);

        $notification = array('message' => 'Subcategory Inserted!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    // delete
    public function delete($id){
        $subcategory = Subcategory::find($id);
        $subcategory->delete();

        $notification = array('message' => 'Subcategory Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // edit method
    public function edit($id){
        // $data = Subcategory::find($id);
        // $category = Category::all();

        $data = Subcategory::find($id);
        $category = DB::table('categories')->get();

        return view('admin.category.subcategory.edit',compact('data','category'));

    }

    public function update(Request $request){
        $subcategory = Subcategory::where('id',$request->id)->first();
        $subcategory -> update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcat_slug' => Str::slug($request->subcategory_name,'-')
        ]);

        $notification = array('message' => 'Subcategory Updated', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }
}
