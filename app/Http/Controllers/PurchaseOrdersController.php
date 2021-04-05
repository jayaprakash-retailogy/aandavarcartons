<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrders;
use App\Models\Customer;
use App\Models\Supplier;
use Response, Redirect;
use App;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PurchaseOrdersController extends Controller
{
    public function list(Request $request) {
        $purchaseorders = PurchaseOrders::all();
        $customers = Customer::with('pocustomers')->get();
        return view('purchaseorders.list', compact('purchaseorders', 'customers'));
    }

    public function create(Request $request) {
        $formtype = 'new';
        $customers = Customer::where('is_active', '1')->get();
        $suppliers = Supplier::where('is_active', '1')->get();

        return view('purchaseorders.create', compact('formtype', 'customers', 'suppliers'));
    }

    public function postpurchaseorders(Request $request) {
        $userid = Auth::id();

        $customer_id = $request->customer_id;
        $purchaseordernumber = $request->purchaseordernumber;
        $purchaseorderdate = $request->purchaseorderdate;
        $terms_of_payment = $request->terms_of_payment;
        $posaveid = $request->poidsave;

        if(isset($posaveid) && !empty($posaveid)) {
            $updatepo = PurchaseOrders::find($posaveid);

            $updatepo->customer_id = $customer_id;
            $updatepo->purchaseordernumber = $purchaseordernumber;
            $updatepo->purchaseorderdate = $purchaseorderdate;
            $updatepo->terms_of_payment = $terms_of_payment;

            $itemscount = count(collect($request)->get('sno'));

            $deactivateitems = DB::table('purchase_orders_items')
                ->where('purchase_orders_id', $posaveid)
                ->update(['is_active' => '0']);

            $now = Carbon::now();

            if($itemscount > 0) {
                for ($i = 0; $i < $itemscount; $i++) {
                    $updateitems = DB::table('purchase_orders_items')
                        ->insert([
                            'purchase_orders_id' => $posaveid,
                            'description' => request('description')[$i],
                            'length' => request('length')[$i],
                            'breadth' => request('breadth')[$i],
                            'height' => request('height')[$i],
                            'quantity' => request('quantity')[$i],
                            'costperbox' => request('costperbox')[$i],
                            'totalcost' => request('totalcost')[$i],
                            'deliverydate' => request('deliverydate')[$i],
                            'deliveredqty' => request('deliveredqty')[$i],
                            'remainingqty' => request('remainingqty')[$i],
                            'remainingstatus' => request('remainingstatus')[$i],
                            'updated_at' => $now,
                        ]);
                }
            }
        } else {
            $insertpo = new PurchaseOrders();
            $insertpo->customer_id = $customer_id;
            $insertpo->purchaseordernumber = strtoupper($purchaseordernumber);
            $insertpo->purchaseorderdate = $purchaseorderdate;
            $insertpo->terms_of_payment = strtoupper($terms_of_payment);
            $insertpo->users_id = $userid;
    
            $insertpo->save();
            $now = Carbon::now();
            $lastid = $insertpo->id;
    
            $itemscount = count(collect($request)->get('sno'));
    
            if($itemscount > 0) {
                for ($i = 0; $i < $itemscount; $i++) {
                    $insertitems = DB::table('purchase_orders_items')
                        ->insert([
                            'purchase_orders_id' => $lastid,
                            'description' => request('description')[$i],
                            'length' => request('length')[$i],
                            'breadth' => request('breadth')[$i],
                            'height' => request('height')[$i],
                            'quantity' => request('quantity')[$i],
                            'costperbox' => request('costperbox')[$i],
                            'totalcost' => request('totalcost')[$i],
                            'deliverydate' => request('deliverydate')[$i],
                            'deliveredqty' => request('deliveredqty')[$i],
                            'remainingqty' => request('remainingqty')[$i],
                            'remainingstatus' => request('remainingstatus')[$i],
                            'created_date' => $now,
                            'created_at' => $now,
                        ]);
                }
            }
        }

        $data = ['code' => '200', 'status' => 'success', 'message' => 'Purchase Order created successfully'];

        return back()->with($data);
        
    }

    public function purchaseorderstatus(Request $request, $id, $status) {
        $update = PurchaseOrders::where('id', $id)->update(['is_active' => $status]);
        $data = ['code' => '200', 'status' => 'success', 'message' => 'Successfully updated status'];
        return back()->with($data);
    }

    public function edit(Request $request) {
        $formtype = 'edit';
        $pid = $request->pid;
        $getpo = PurchaseOrders::where('id', $pid)->first();

        $purchaseorderitems = DB::table('purchase_orders_items')
                            ->where('purchase_orders_id', $pid)
                            ->where('is_active', '1')
                            ->get();

        $customers = Customer::with('pocustomers')->get();
        return view('purchaseorders.create', compact('formtype', 'customers', 'getpo', 'purchaseorderitems'));
    }

    public function purchaseorderProgressStatus($id, $status) {
        $update = PurchaseOrders::where('id', $id)->update(['status' => $status]);

        if($update) {
            $data = ['code' => '200', 'status' => 'success', 'message' => 'Successfully updated Jobcard Status'];
        } else {
            $data = ['code' => '100', 'status' => 'failure', 'message' => 'Something went wrong. Try again later'];
        }

        return back()->with($data);
    }    

    public function potoinvoice(Request $request) {
        $id = $request->id;
        $formtype = 'new';

        $setting = DB::table('settings')->first();

        $purchaseorders = DB::table('purchase_orders')
        ->where('is_active', '1')
        ->get();

        $podata = DB::table('purchase_orders')
        ->where('id', $id)
        ->first();

        $purchaseorderitems = DB::table('purchase_orders_items')
        ->where('purchase_orders_id', $id)
        ->where('is_active', '1')
        ->get();

        return view('invoice.potoinv', compact('formtype', 'purchaseorders', 'podata', 'purchaseorderitems', 'setting'));
    }
}
