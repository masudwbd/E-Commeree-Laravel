<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('coupons')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionbtn = '<a href="#" class="btn btn-info edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" id="edit"> <i class="fas fa-edit"></i> </a>
                    <a href="'.route('coupon.delete', [$row->id]).'" data-id="" class="btn btn-danger" id="delete_coupon"> <i class="fas fa-trash"></i>
                    </a>';

                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.offer.coupon.index');
    }

    public function store(Request $request){
        $data = array();
        $data['coupon_code'] = $request->coupon_code;
        $data['type'] = $request->coupon_type;
        $data['coupon_amount'] = $request->coupon_amount;
        $data['valid_date'] = $request->valid_date;
        $data['status'] = $request->status;

        DB::table('coupons')->insert($data);
        return response()->json('coupon_inserted');
    }
    
    public function destroy($id){
        DB::table('coupons')->where('id' , $id)->delete();
        return response()->json('coupon_deleted');
    }

    public function edit($id){
        $data = DB::table('coupons')->where('id', $id)->first();
        return view('admin.offer.coupon.edit', compact('data'));
    }
    public function update(Request $request){
        $data = array();
        $data['coupon_code'] = $request->coupon_code;
        $data['type'] = $request->coupon_type;
        $data['coupon_amount'] = $request->coupon_amount;
        $data['valid_date'] = $request->valid_date;
        $data['status'] = $request->status;

        DB::table('coupons')->where('id', $request->id)->update($data);
        return response()->json('coupon_updated');

    }
}
