<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use File;
use Image;
class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function seo()
    {
        $data = DB::table('seos')->first();
        return view('admin.setting.seo', compact('data'));
    }
    public function update(Request $request, $id)
    {
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
    public function smtp()
    {
        $data = DB::table('smtp')->first();
        return view('admin.setting.smtp', compact('data'));
    }
    public function smtp_update(Request $request, $id)
    {
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
    public function website()
    {
        $data = DB::table('settings')->first();

        return view('admin.setting.web', compact('data'));

    }

    public function web_update(Request $request, $id){
        $data = array();
        $data['currency'] = $request->currency;
        $data['phone_one'] = $request->phone_one;
        $data['phone_two'] = $request->phone_two;
        $data['main_email'] = $request->main_email;
        $data['support_email'] = $request->support_email;
        $data['address'] = $request->address;
        $data['facebook'] = $request->facebook;
        $data['twitter'] = $request->twitter;
        $data['instagram'] = $request->instagram;
        $data['linkdin'] = $request->linkdin;
        $data['youtube'] = $request->youtube;

        if($request->logo){
            if(File::exists($request->old_logo)){
                unlink($request->old_logo);
            };
            $photo=$request->logo;
            $photoname = uniqid().'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(200, 150)->save('backend/files/settings/'.$photoname);
            $data['logo'] = 'backend/files/settings/'.$photoname;
        }else{
            $data['logo'] = $request->old_logo;
        }
        if($request->favicon){
            if(File::exists($request->old_logo)){
                unlink($request->old_logo);
            };
            $photo=$request->favicon;
            $photoname = uniqid().'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(32, 32)->save('backend/files/settings/'.$photoname);
            $data['favicon'] = 'backend/files/settings/'.$photoname;
        }else{
            $data['favicon'] = $request->old_logo;
        }

        DB::table('settings')->where('id', $id)->update($data);
        $notification = array('message' => 'web settings updated', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function payment_gateway(){
        $aamarpay = DB::table('payment_gateway_bd')->first();
        $surjopay = DB::table('payment_gateway_bd')->skip(1)->first();
        $ssl = DB::table('payment_gateway_bd')->skip(2)->first();

        return view('admin.bd_payment_gateway.edit', compact('aamarpay','surjopay','ssl'));
    }
    public function aamarpay_payment_gateway(Request $request){
        $data = array(
            'store_id' => $request->store_id,
            'signature_id' => $request->signature_id,
            'status' => $request->status,
        );
        DB::table('payment_gateway_bd')->where('id', $request->id)->update($data);
        $notification = array('message' => 'payment gateway updated', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function surjopay_payment_gateway(Request $request){
        $data = array(
            'store_id' => $request->store_id,
            'signature_id' => $request->signature_id,
            'status' => $request->status,
        );
        DB::table('payment_gateway_bd')->where('id', $request->id)->update($data);
        $notification = array('message' => 'payment gateway updated', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function ssl_payment_gateway(Request $request){
        $data = array(
            'store_id' => $request->store_id,
            'signature_id' => $request->signature_id,
            'status' => $request->status,
        );
        DB::table('payment_gateway_bd')->where('id', $request->id)->update($data);
        $notification = array('message' => 'payment gateway updated', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}