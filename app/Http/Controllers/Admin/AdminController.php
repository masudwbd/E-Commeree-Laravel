<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Admin After login
    public function admin(){
        return view('admin.home');
    }

    // Admin After Logout
    public function logout(){
        Auth::logout();
        $notification = array('message' => 'You are logged out!', 'alert-type' => 'success');
        return redirect()->route('admin.login')->with($notification);
    }
    public function Password_Change(){
        return view('admin.profile.password_change');
    }

    public function Password_Update(Request $request){
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $current_pass = Auth::user()->password;
        $old_pass = $request->old_password;
        $new_pass = $request->password;

        if(Hash::check($old_pass, $current_pass)){
            $user = User::findorfail(Auth::id());
            $user->password = Hash::make($new_pass);
            $user->save();
            Auth::logout();
            $notification = array('message' => 'You have successfully updated your password!', 'alert-type' => 'success');

            return redirect()->route('admin.login')->with($notification);
        }else{
            $notification = array('message' => 'Old Password is incorrect!', 'alert-type' => 'error');

            return redirect()->back()->with($notification);
        }
    }
}
