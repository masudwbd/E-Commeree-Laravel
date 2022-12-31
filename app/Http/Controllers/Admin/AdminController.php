<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

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
}