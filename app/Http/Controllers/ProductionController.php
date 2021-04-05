<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\JobCard;
use App\Models\JobCardPly;
use App\Models\UserModel;
use App\Models\PurchaseOrders;
use App\Models\Supplier;
use Redirect;
use Carbon\Carbon;
use DB;

class ProductionController extends Controller
{
    public function productionsummary(Request $request) {
        $summary = DB::table('purchase_orders as po')
        ->leftjoin('purchase_orders_items as poi', 'poi.purchase_orders_id', 'po.id')
        ->select('po.*', 'poi.*')
        ->get();

        return view('report.list', compact('summary'));
    }

    public function stocksummary(Request $request) {
        $stocks = DB::table('roll_stock as rs')
        ->leftjoin('stock_items as si', 'si.rollstockid', 'rs.id')
        ->get();
        
        $suppliers = Supplier::with('supplier')->get();
        
        return view('report.stocklist', compact('stocks', 'suppliers'));
    }
}
