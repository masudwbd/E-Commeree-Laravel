<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function seo(){
        $data = DB::table('seos')->first();
        return view('admin.setting.seo', compact('data'));
    }
    public function update(Request $request, $id){
        $data = array();
        $data['meta_title'] = $request->meta_title;
        $data['meta_author'] = $request->meta_author;
        $data['meta_tag'] = $request->meta_tag;
        $data['meta_description'] = $request->meta_description;
        $data['google_verification'] = $request->google_verification;
        $data['alexa_verification'] = $request->alexa_verification;
        $data['google_analytics'] = $request->google_analytics;
        $data['google_adsense'] = $request->google_adsense;

        DB::table('seos')->where('id', $id)->update($data);
        $notification = array('message' => 'seos updated', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function smtp(){
        $data = DB::table('smtp')->first();
        return view('admin.setting.smtp', compact('data'));
    }
    public function smtp_update(Request $request, $id){
        $data = array();
        $data['mailer'] = $request->mailer;
        $data['host'] = $request->host;
        $data['port'] = $request->port;
        $data['user_name'] = $request->user_name;
        $data['password'] = $request->password;

        DB::table('smtp')->where('id', $id)->update($data);
        $notification = array('message' => 'smtp updated', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

}
