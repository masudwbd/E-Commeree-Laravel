<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        if ($request->ajax()) {
            $orders = "";
            $query = DB::table('orders')->orderBy('id','DESC');
                if($request->payment_type){
                    $query->where('payment_type', $request->payment_type);
                }
                if($request->date){
                $order_date = date('d-m-Y', strtotime($request->date));
                    $query->where('date', $order_date);
                }
                if($request->status==0){
                    $query->where('status', 0);
                }
                if($request->status==1){
                    $query->where('status', 1);
                }
                if($request->status==2){
                    $query->where('status', 2);
                }
                if($request->status==3){
                    $query->where('status', 3);
                }
                if($request->status==4){
                    $query->where('status', 4);
                }
                if($request->status==5){
                    $query->where('status', 5);
                }

            $orders = $query->get();
            return DataTables::of($orders)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if($row->status==0){
                        return '<span class="badge badge-danger"> Pending </span>';
                    }elseif($row->status==1){
                        return '<span class="badge badge-info"> Recieved </span>';
                    }
                    elseif($row->status==2){
                        return '<span class="badge badge-primary"> Shipped </span>';
                    }
                    elseif($row->status==3){
                        return '<span class="badge badge-success"> Completed </span>';
                    }
                    elseif($row->status==4){
                        return '<span class="badge badge-warning"> Return </span>';
                    }
                    elseif($row->status==5){
                        return '<span class="badge badge-danger"> Caceled </span>';
                    }
                })
                ->addColumn('action', function($row) {
                    $actionbtn = '
                    <a href="#" data-id="'.$row->id.'" class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#statusmodal"><i class="fas fa-eye"></i></a> ';
                    return $actionbtn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.order.index');
    }

    public function edit($id){
        $order = DB::table('orders')->where('id', $id)->first();
        $order_details = DB::table('order_details')->where('order_id', $order->id)->get();
        return view('admin.order.edit', compact('order','order_details'));
     }

    public function update(Request $request){
        $data = array(
            'status' => $request->status,
        );
        DB::table('orders')->where('id', $request->id)->update($data);
        $notification = array('message' => 'Status Updated','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    //reports

    public function order_reports(Request $request){
        if ($request->ajax()) {
            $orders = "";
            $query = DB::table('orders')->orderBy('id','DESC');
                if($request->payment_type){
                    $query->where('payment_type', $request->payment_type);
                }
                if($request->date){
                $order_date = date('d-m-Y', strtotime($request->date));
                    $query->where('date', $order_date);
                }
                if($request->status==0){
                    $query->where('status', 0);
                }
                if($request->status==1){
                    $query->where('status', 1);
                }
                if($request->status==2){
                    $query->where('status', 2);
                }
                if($request->status==3){
                    $query->where('status', 3);
                }
                if($request->status==4){
                    $query->where('status', 4);
                }
                if($request->status==5){
                    $query->where('status', 5);
                }

            $orders = $query->get();
            return DataTables::of($orders)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if($row->status==0){
                        return '<span class="badge badge-danger"> Pending </span>';
                    }elseif($row->status==1){
                        return '<span class="badge badge-info"> Recieved </span>';
                    }
                    elseif($row->status==2){
                        return '<span class="badge badge-primary"> Shipped </span>';
                    }
                    elseif($row->status==3){
                        return '<span class="badge badge-success"> Completed </span>';
                    }
                    elseif($row->status==4){
                        return '<span class="badge badge-warning"> Return </span>';
                    }
                    elseif($row->status==5){
                        return '<span class="badge badge-danger"> Caceled </span>';
                    }
                })
                ->addColumn('action', function($row) {
                    $actionbtn = '
                    <a href="#" data-id="'.$row->id.'" class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#statusmodal"><i class="fas fa-eye"></i></a> ';
                    return $actionbtn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.reports.orders.index');
    }

    public function order_print(Request $request){
        if ($request->ajax()) {
            $orders = "";
            $query = DB::table('orders')->orderBy('id','DESC');
                if($request->payment_type){
                    $query->where('payment_type', $request->payment_type);
                }
                if($request->date){
                $order_date = date('d-m-Y', strtotime($request->date));
                    $query->where('date', $order_date);
                }
                if($request->status==0){
                    $query->where('status', 0);
                }
                if($request->status==1){
                    $query->where('status', 1);
                }
                if($request->status==2){
                    $query->where('status', 2);
                }
                if($request->status==3){
                    $query->where('status', 3);
                }
                if($request->status==4){
                    $query->where('status', 4);
                }
                if($request->status==5){
                    $query->where('status', 5);
                }

            $orders = $query->get();
        }
        return view('admin.reports.orders.print', compact('orders'));
    }
}
