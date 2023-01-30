<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use DB;
use Image;
use Str;
use File;
use App\Models\User;
class ProfileController extends Controller
{
    public function dashboard(){
        $orders = DB::table('orders')->where('user_id', Auth::id())->orderBy('id', 'DESC')->take(10)->get();
        $complete_orders = DB::table('orders')->where('user_id', Auth::id())->where('status', 3)->get();
        $total_orders = DB::table('orders')->where('user_id', Auth::id())->get();
        $pending_orders = DB::table('orders')->where('user_id', Auth::id())->where('status', 0)->get();
        $cancel_orders = DB::table('orders')->where('user_id', Auth::id())->where('status', 5)->get();
        return view('frontend.user.dashboard', compact('orders','complete_orders','total_orders','pending_orders','cancel_orders'));
    }
    public function review(){
        return view('frontend.user.review');
    }
    public function settings(){
        return view('frontend.user.settings');
    }
    public function user_open_ticket(){
        $tickets = DB::table('tickets')->where('user_id', Auth::id())->take(10)->get();
        return view('frontend.user.open_ticket', compact('tickets'));
    }
    public function order_list(){
        $orders = DB::table('orders')->where('user_id', Auth::id())->orderBy('id', 'DESC')->take(10)->get();
        return view('frontend.user.orderlist', compact('orders'));
    }
    public function user_create_ticket(){
        return view('frontend.user.create_ticket');
    }
    public function user_store_ticket(Request $request){
        $data = array(
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'service' => $request->service,
            'priority' => $request->priority,
            'message' => $request->message,
        );
        $photo = $request->image;
        $photoname = uniqid().'.'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(240, 120)->save('backend/files/tickets/'.$photoname);

        $data['image'] = 'backend/files/tickets/'.$photoname;

        DB::table('tickets')->insert($data);
        
        $notification = array('message' => 'Ticket Inserted', 'alert-type' => 'success');

        return redirect()->back()->with($notification);

    }

    public function ticket_show($id){
        $ticket = DB::table('tickets')->where('id', $id)->first();
        $replies = DB::table('replies')->where('ticket_id', $ticket->id)->get();
        return view('frontend.user.show_ticket', compact('ticket','replies'));
    }

    public function ticket_delete($id){
        DB::table('tickets')->where('id', $id)->delete();
        $notification = array('message' => 'Ticket Deleted', 'alert-type' => 'error');
        return redirect()->back()->with($notification);
    }

    public function user_password_change(Request $request){
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

    public function order_details($id){
        $order = DB::table('orders')->where('id', $id)->first();
        $ordered_items = DB::table('order_details')->where('order_id', $id)->get();
        return view('frontend.user.order.orders_details', compact('ordered_items','order'));
    }

    public function image_add(Request $request){
        $user = User::findorfail(Auth::id());
        $slug = Str::slug($user->name,'-');
        $photo = $request->profile_picture;
        $photoname = $slug . '.' . $photo->getClientOriginalExtension();
        Image::make($photo)->resize(300,300)->save('backend/files/profile_pictures/'.$photoname);
        $image = 'backend/files/profile_pictures/' . $photoname;
        $user->image = $image;
        $user->save();

        $notification = array('message' => 'Profile Picture Uploaded', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function image_update(Request $request)
    {
        $user = User::findorfail(Auth::id());
        $slug = Str::slug($user->name, '-');
        if ($request->profile_picture) {
            if(File::exists($request->old_profile_picture)){
                unlink($request->old_profile_picture);
            }
            $photo = $request->profile_picture;
            $photoname = $slug . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(300, 300)->save('backend/files/profile_pictures/' . $photoname);
            $image = 'backend/files/profile_pictures/' . $photoname;
            $user->image = $image;
            $user->save();

            $notification = array('message' => 'Profile Picture Updated', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {
            $user->image = $request->old_profile_picture;
            $user->save();

            $notification = array('message' => 'Profile Picture Updated', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }

    }
}
