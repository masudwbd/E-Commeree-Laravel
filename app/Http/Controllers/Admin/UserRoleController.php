<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Auth;
class UserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $admin_users = DB::table('users')->where('is_admin', '1')->get();

        return view('admin.setting.user_role.index', compact('admin_users'));
    }

    public function edit($id){
        $user = DB::table('users')->where('id',$id)->first();
        return view('admin.setting.user_role.edit', compact('user'));
    }

    public function update(Request $request){
        $user = User::findorfail($request->id);
        $user->role = $request->user_role;
        $user->save();

        $notification = array('message' => 'User Role Updated', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
