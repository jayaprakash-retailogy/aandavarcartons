<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\JobCard;
use App\Models\JobCardPly;
use App\Models\UserModel;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\PurchaseOrders;
use Redirect;
use Carbon\Carbon;
use DB;

class StockController extends Controller
{
    public function list(Request $request) {
        $stocks = DB::table('roll_stock as rs')
        ->leftjoin('stock_items as si', 'si.rollstockid', 'rs.id')
        ->get();
        
        $suppliers = Supplier::with('supplier')->get();
        
        return view('stock.list', compact('stocks', 'suppliers'));
    }

    public function create(Request $request) {
        $suppliers = Supplier::where('is_active', '1')->get();
        $purchaseorders = PurchaseOrders::where('is_active', '1')->get();
        $formtype = 'new';
        
        return view('stock.create', compact('suppliers', 'purchaseorders', 'formtype'));
    }

    public function poststock(Request $request) {
        $user_id = Auth::id();
        $created_date = Carbon::now()->toDateTimeString();

        $stocksaveid = request('stocksaveid');
        $supplier_id = request('supplier_id');
        $purchaseordernumber = request('purchaseordernumber');
        $purchaseorderdate = request('purchaseorderdate');
        $purchaseorderid = request('purchaseorderid');

        if(isset($stocksaveid) && !empty($stocksaveid)) {
            $updatestock = Stock::find($stocksaveid);

            $updatestock->supplier_id = $supplier_id;
            $updatestock->purchaseordernumber = $purchaseordernumber;
            $updatestock->purchaseorderdate = $purchaseorderdate;
            $updatestock->purchaseorderid = $purchaseorderid;

            $itemscount = count(collect($request)->get('sno'));

            $deleteitems = DB::table('stock_items')
                ->where('rollstockid', $stocksaveid)
                ->delete();

            $now = Carbon::now();

            if($itemscount > 0) {
                for ($i = 0; $i < $itemscount; $i++) {
                    $updateitems = DB::table('stock_items')
                        ->insert([
                            'rollstockid' => $stocksaveid,
                            'productno' => request('productno')[$i],
                            'length' => request('length')[$i],
                            'breadth' => request('breadth')[$i],
                            'height' => request('height')[$i],
                            'weight' => request('weight')[$i],
                            'burstingfactor' => request('burstingfactor')[$i],
                            'color' => request('color')[$i],
                            'quantity' => request('quantity')[$i],
                            'date' => $now,
                        ]);
                }
            }
        } else {
            $insertstock = new Stock();
            $insertstock->user_id = $user_id;
            $insertstock->supplier_id = $supplier_id;
            $insertstock->purchaseordernumber = $purchaseordernumber;
            $insertstock->purchaseorderdate = $purchaseorderdate;
            $insertstock->purchaseorderid = $purchaseorderid;
            $insertstock->created_date = now();

            $insertstock->save();
            $stocksaveid = $insertstock->id;

            $itemscount = count(collect($request)->get('sno'));

            $deleteitems = DB::table('stock_items')
                ->where('rollstockid', $stocksaveid)
                ->delete();

            $now = Carbon::now();

            if($itemscount > 0) {
                for ($i = 0; $i < $itemscount; $i++) {
                    $insertitems = DB::table('stock_items')
                        ->insert([
                            'rollstockid' => $stocksaveid,
                            'productno' => request('productno')[$i],
                            'length' => request('length')[$i],
                            'breadth' => request('breadth')[$i],
                            'height' => request('height')[$i],
                            'weight' => request('weight')[$i],
                            'burstingfactor' => request('burstingfactor')[$i],
                            'color' => request('color')[$i],
                            'quantity' => request('quantity')[$i],
                            'date' => $now,
                        ]);
                }
            }
        }

        return back();
    }

    public function stockStatus(Request $request, $id, $status) {
        $update = Stock::where('id', $id)->update(['is_active' => $status]);

        if($update) {
            $data = ['code' => '200', 'status' => 'success', 'message' => 'Successfully updated Jobcard'];
        } else {
            $data = ['code' => '100', 'status' => 'failure', 'message' => 'Something went wrong. Try again later'];
        }

        return back()->with($data);
    }
    
    public function edit(Request $request) {
        $id = $request->id;
        $formtype = 'edit';
        $getstock = Stock::where('id', $id)->first();
        $stockitems = DB::table('stock_items')
        ->where('rollstockid', $id)
        ->get();
        $suppliers = Supplier::where('is_active', '1')->get();
        $purchaseorders = PurchaseOrders::where('is_active', '1')->get();

        return view('stock.create', compact('getstock', 'stockitems', 'suppliers', 'purchaseorders', 'formtype'));
    }
}
