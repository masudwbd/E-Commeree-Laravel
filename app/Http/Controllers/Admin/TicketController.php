<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Auth;
use Image;
class TicketController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $ticket = "";
            $query = DB::table('tickets')->leftJoin('users', 'tickets.user_id', 'users.id');
                if($request->date){
                    $query->where('tickets.date', $request->date);
                }
                if($request->service=='technical'){
                    $query->where('tickets.service', $request->service);
                }
                if($request->service=='payment'){
                    $query->where('tickets.service', $request->service);
                }
                if($request->service=='affilate'){
                    $query->where('tickets.service', $request->service);
                }
                if($request->service=='return'){
                    $query->where('tickets.service', $request->service);
                }
                if($request->service=='refund'){
                    $query->where('tickets.service', $request->service);
                }
                if($request->status==1){
                    $query->where('tickets.status', 1);
                }
                if($request->status==2){
                    $query->where('tickets.status', 2);
                }
                if($request->status==3){
                    $query->where('tickets.status', 3);
                }

            $ticket = $query->select('tickets.*','users.name')->get();
            return DataTables::of($ticket)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if($row->status==0){
                        return '<span class="badge badge-info"> Pending </span>';
                    }elseif($row->status==1){
                        return '<span class="badge badge-success"> Running </span>';
                    }
                    elseif($row->status==2){
                        return '<span class="badge badge-danger"> Closed </span>';
                    }
                })
                ->addColumn('action', function($row) {
                    $actionbtn = '
                    <a href="'.route('ticket.show', [$row->id]).'" class="btn btn-warning"> <i class="fas fa-eye"></i>
                    </a>
                    <a href="'.route('ticket.delete', [$row->id]).'" class="btn btn-danger" id="delete_ticket"> <i class="fas fa-trash"></i>
                    </a>';
                    return $actionbtn;
                })
                ->rawColumns(['action', 'status','service'])
                ->make(true);
        }
        return view('admin.ticket.index');
    }

    public function ticket_show($id){
        $ticket = DB::table('tickets')->leftJoin('users', 'tickets.user_id', 'users.id')->select('tickets.*', 'users.name')->where('tickets.id', $id)->first();
        $replies = DB::table('replies')->where('ticket_id',$ticket->id)->get();
        return view('admin.ticket.show_ticket', compact('ticket','replies'));
    }

    public function ticket_reply(Request $request){
        $data = array(
            'user_id' => Auth::id(),
            'ticket_id' => $request->ticket_id,
            'message' => $request->message,
            'date' => date('d-m-y')
        );
        if($request->image){
            $photo = $request->image;
            $photoname = hexdec(uniqid() . '.' . $photo->getClientOriginalExtension());
            Image::make($photo)->resize(150, 150)->save('backend/files/tickets/' . $photoname);

            $data['image'] = 'backend/files/products/tickets/'.$photoname;
        }

        DB::table('tickets')->where('id', $request->ticket_id)->update(['status' => 1]);

        DB::table('replies')->insert($data);
        
        $notification = array('message' => 'Successfully replied', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    public function ticket_close($id){
        DB::table('tickets')->where('id', $id)->update(['status' => 2]);
        $notification = array('message' => 'Successfully closed', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    public function destroy($id){
        DB::table('tickets')->where('id', $id)->delete();
        $notification = array('message' => 'Ticket Deleted', 'alert-type' => 'error');
        return redirect()->back()->with($notification);
    }
}
