<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class WarehouseController extends Controller
{
    public function __construct()
    {value="{{old('video')}}"
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('warehouses')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="#" class="btn btn-info edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal" id="edit"> <i class="fas fa-edit"></i> </a>
                    <a href="' . route('warehouse.delete', [$row->id]) . '" class="btn btn-danger" id="delete"> <i class="fas fa-trash"></i>
                    </a>';
                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.category.warehouse.index');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'warehouse_name' => 'required|unique:warehouses'
        ]);

        $data = array();
        $data['warehouse_name'] = $request->warehouse_name;
        $data['warehouse_address'] = $request->warehouse_address;
        $data['warehouse_phone'] = $request->warehouse_phone;

        DB::table('warehouses')->insert($data);

        $notification = array('message' => 'Warehouse Inserted!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        DB::table('warehouses')->where('id', $id)->delete();

        $notification = array('message' => 'Warehouse Deleted!', 'alert-type' => 'error');
        return redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $warehouse = DB::table('warehouses')->where('id', $id)->first();
        return view('admin.category.warehouse.edit', compact('warehouse'));
    }

    public function update(Request $request)
    {
        $data = array();
        $data['warehouse_name'] = $request->warehouse_name;
        $data['warehouse_address'] = $request->warehouse_address;
        $data['warehouse_phone'] = $request->warehouse_phone;

        DB::table('warehouses')->where('id', $request->id)->update($data);
        $notification = array('message' => 'Warehouse Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}