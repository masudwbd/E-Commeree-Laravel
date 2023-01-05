<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class PickupPointController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('pickup_points')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="#" class="btn btn-info edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal" id="edit"> <i class="fas fa-edit"></i> </a>
                    <a href="' . route('pickup_point.delete', [$row->id]) . '" class="btn btn-danger" id="delete"> <i class="fas fa-trash"></i>
                    </a>';
                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.offer.pickup_point.index');
    }
    public function store(Request $request){
        $data = array();
        $data['pickup_point_name'] = $request->pickup_point_name;
        $data['pickup_point_address'] = $request->pickup_point_address;
        $data['pickup_point_phone'] = $request->pickup_point_phone;
        $data['pickup_point_phone_two'] = $request->pickup_point_phone_two;

        DB::table('pickup_points')->where('id', $request->id)->insert($data);
        return response()->json('Pickup Point Inserted');
    }

    public function destroy($id){
        DB::table('pickup_points')->where('id', $id)->delete();
        return response()->json('Pickup Point Deleted');
    }

    public function edit($id){
        $data = DB::table('pickup_points')->where('id', $id)->first();
        return view('admin.offer.pickup_point.edit', compact('data'));
    }

    public function update(Request $request){
        $data = array();
        $data['pickup_point_name'] = $request->pickup_point_name;
        $data['pickup_point_address'] = $request->pickup_point_address;
        $data['pickup_point_phone'] = $request->pickup_point_phone;
        $data['pickup_point_phone_two'] = $request->pickup_point_phone_two;

        DB::table('pickup_points')->where('id', $request->id)->update($data);
        return response()->json('Pickup Point Updated');
    }
}
