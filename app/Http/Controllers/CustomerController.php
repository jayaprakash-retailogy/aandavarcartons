<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Response, Redirect;
use App;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function create() {
        $customers = Customer::all();
        $data = ['customers' => $customers];
        return view('customer.create')->with($data);
    }

    public function submit(Request $reqeust) {
        $user_id = Auth::id();

        $customer_name = strtoupper(request('name'));
        $customer_gst = strtoupper(request('gst'));
        $customer_address = strtoupper(request('address'));
        $customer_phone = request('phone');
        $customer_email = request('email');

        $customer = new Customer();
        $customer->name = $customer_name;
        $customer->gst = $customer_gst;
        $customer->address = $customer_address;
        $customer->phone = $customer_phone;
        $customer->email = $customer_email;
        $customer->added_by = $user_id;

        if($customer->save()) {
            $data = ['message' => "Successfully added customer data", 'status' => 'success', 'code' => '200'];
        } else {
            abort(500);
        }

        return back()->with($data);
    }

    public function customerStatus($id, $status) {
        $update = Customer::where('id', $id)->update(['is_active' => $status]);

        if($update) {
            $data = ['code' => '200', 'status' => 'success', 'message' => 'Successfully updated customer'];
        } else {
            $data = ['code' => '100', 'status' => 'failure', 'message' => 'Something went wrong. Try again later'];
        }

        return back()->with($data);
    }

    public function editCreate($id) {
        $customer = Customer::where('id', $id)->first();
        $data = ['customer' => $customer];

        return response()->json($data);
    }

    public function editSubmit(Request $reqeust) {
        $user_id = Auth::id();

        $customer_id = request('id');
        $customer_name = strtoupper(request('name'));
        $customer_gst = strtoupper(request('gst'));
        $customer_address = strtoupper(request('address'));
        $customer_phone = request('phone');
        $customer_email = request('email');

        $customer = Customer::find($customer_id);

        $customer->name = $customer_name;
        $customer->gst = $customer_gst;
        $customer->address = $customer_address;
        $customer->phone = $customer_phone;
        $customer->email = $customer_email;

        if($customer->save()) {
            $data = ['message' => "Successfully updated customer data", 'status' => 'success', 'code' => '200'];
        } else {
            abort(500);
        }

        return back()->with($data);
    }
}
