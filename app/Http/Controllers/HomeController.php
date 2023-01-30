<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use DB; 
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->to('/');
    }

    public function logout(){
        Auth::logout();
        return redirect()->back();
    }

    public function blog(){
        $page = DB::table('pages')->where('page_position', '1')->first();
        $blogs = DB::table('blogs')->where('status', 1)->get();
        return view('frontend.blog', compact('page','blogs'));
    }
    
}
