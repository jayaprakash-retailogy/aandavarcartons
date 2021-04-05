<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Supplier;
use Response, Redirect;
use App;

class SupplierController extends Controller
{
    public function create() {
        $suppliers = Supplier::all();
        $data = ['suppliers' => $suppliers];
        return view('supplier.create')->with($data);
    }

    public function submit(Request $reqeust) {
        $user_id = Auth::id();

        $supplier_name = strtoupper(request('name'));
        $supplier_gst = strtoupper(request('gst'));
        $supplier_address = strtoupper(request('address'));
        $supplier_phone = request('phone');
        $supplier_email = request('email');

        $supplier = new Supplier();
        $supplier->name = $supplier_name;
        $supplier->gst = $supplier_gst;
        $supplier->address = $supplier_address;
        $supplier->phone = $supplier_phone;
        $supplier->email = $supplier_email;
        if($supplier->save()) {
            $data = ['message' => "Successfully added Purchase data.", 'status' => 'success', 'code' => '200'];
        } else {
            abort(500);
        }

        return back()->with($data);
    }

    public function supplierStatus($id, $status) {
        $update = Supplier::where('id', $id)->update(['is_active' => $status]);

        if($update) {
            $data = ['code' => '200', 'status' => 'success', 'message' => 'Successfully updated category'];
        } else {
            $data = ['code' => '101', 'status' => 'failure', 'message' => 'Something went wrong. Try again later'];
        }

        return back()->with($data);
    }

    public function editCreate($id) {
        $supplier = Supplier::where('id', $id)->first();
        $data = ['supplier' => $supplier];

        return response()->json($data);
    }

    public function editSubmit(Request $reqeust) {
        $user_id = Auth::id();

        $supplier_id = request('id');
        $supplier_name = strtoupper(request('name'));
        $supplier_gst = strtoupper(request('gst'));
        $supplier_address = strtoupper(request('address'));
        $supplier_phone = request('phone');
        $supplier_email = request('email');

        $supplier = Supplier::find($supplier_id);

        $supplier->name = $supplier_name;
        $supplier->gst = $supplier_gst;
        $supplier->address = $supplier_address;
        $supplier->phone = $supplier_phone;
        $supplier->email = $supplier_email;

        if($supplier->save()) {
            $data = ['message' => "Successfully updated Supplier data", 'status' => 'success', 'code' => '200'];
        } else {
            abort(500);
        }

        return back()->with($data);
    }
}
