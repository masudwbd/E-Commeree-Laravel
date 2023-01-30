<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use Str;
use Image;
use File;
use DB;
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
        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'category_slug' => Str::slug($request->category_name,'-'),
        // ]);

        $data = array();

        $data['category_name'] = $request->category_name;
        $data['category_slug'] = Str::slug($request->category_name,'-');

        $slug = Str::slug($request->category_name,'-');

        $photo = $request->icon;
        $photoname = $slug.'.'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(150, 150)->save('backend/files/category_icons/'.$photoname);

        $data['icon'] = 'backend/files/category_icons/'.$photoname;
            
        DB::table('categories')->insert($data);
        
        $notification = array('message' => 'Category Inserted','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function edit($id){
        // $data=DB::table('categories')->where('id',$id)->first();
        $data = Category::findorfail($id);
        return view('admin.category.category.edit', compact('data'));
    }

    public function update(Request $request){
        $data = array();

        $data['category_name'] = $request->category_name;
        $data['category_slug'] = Str::slug($request->category_name,'-');

        $slug = Str::slug($request->category_name,'-');

        if($request->icon){
            if(File::exists($request->oldicono)){
                unlink($request->old_icon);
            };
            $photo = $request->icon;
            $photoname = $slug.'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(150, 150)->save('backend/files/category_icons/'.$photoname);

            $data['icon'] = 'backend/files/category_icons/'.$photoname;
            DB::table('categories')->where('id', $request->id)->update($data);

            $notification = array('message' => 'Category Updated!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }else{
            $data['icon'] = $request->old_icon;
            DB::table('categories')->where('id', $request->id)->update($data);
            $notification = array('message' => 'Category Updated!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
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
