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

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function blog_index(Request $request){
        if($request->ajax()){
            $data = DB::table('blogs')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionbtn = '<a href="#" class="btn btn-info edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" id="edit"> <i class="fas fa-edit"></i> </a>
                    <a href="'.route('blog.delete', [$row->id]).'" class="btn btn-danger" id="delete_blog"> <i class="fas fa-trash"></i>
                    </a>';

                    return $actionbtn;
                })
                -> rawColumns(['action'])
                ->make(true);
        }
        $blogs = DB::table('blogs')->get();
        return view('admin.blog.blogs.index', compact('blogs'));
    }

    public function blog_store(Request $request){
        $data = array(
            'blog_category_id' => $request->blog_category,
            'title' => $request->blog_name,
            'description' => $request->blog_description,
            'publish_date' => $request->date,
            'tag' => $request->tags,
            'slug' => Str::slug($request->blog_name, '-'),
        );

        $slug = Str::slug($request->blog_name, '-');


        $photo = $request->thumbnail;
        $photoname = $slug . '.' . $photo->getClientOriginalExtension();
        Image::make($photo)->resize(720, 1080)->save('backend/files/blogs/'.$photoname);
        $data['thumbnail'] = 'backend/files/blogs/'.$photoname;

        DB::table('blogs')->insert($data);

        $notification = array('message' => 'Blog Inserted', 'alert-type' => 'success');
        return redirect()->back()->with($notification);  
        
    }

    public function blog_delete($id){
        DB::table('blogs')->where('id', $id)->delete();
        $notification = array('message' => 'Blog Deleted', 'alert-type' => 'error');
        return redirect()->back()->with($notification);  
    }

    public function blog_edit($id){
        $blog = DB::table('blogs')->where('id', $id)->first();
        return view('admin.blog.blogs.edit', compact('blog'));
    }
    
    public function blog_update(Request $request){

        $data = array(
            'blog_category_id' => $request->blog_category,
            'title' => $request->blog_name,
            'description' => $request->blog_description,
            'publish_date' => $request->date,
            'tag' => $request->tags,
            'slug' => Str::slug($request->blog_name, '-'),
        );

        $slug = Str::slug($request->blog_name, '-');

        if($request->thumbnail){
            if(File::exists($request->old_thumbnail)){
                unlink($request->old_thumbnail);
            }
            $photo = $request->thumbnail;
            $photoname = $slug . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(720, 1080)->save('backend/files/blogs/'.$photoname);
            $data['thumbnail'] = 'backend/files/blogs/'.$photoname;
            DB::table('blogs')->where('id', $request->id)->update($data);

            $notification = array('message' => 'Blog Updated', 'alert-type' => 'success');
            return redirect()->back()->with($notification);  
        }
        $data['thumbnail'] = $request->old_thumbnail;
        dd($data);
        DB::table('blogs')->where('id', $request->id)->update($data);

        $notification = array('message' => 'Blog Updated', 'alert-type' => 'success');
        return redirect()->back()->with($notification);  
    }
}
