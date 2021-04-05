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

class ReportController extends Controller
{
    public function purchasereport(Request $request) {
        $purchases = DB::table('invoice_items as ini')
        ->leftjoin('invoice as in', 'in.id', 'ini.invoiceid')
        ->leftjoin('purchase_orders as po', 'in.pono', 'po.id')
        ->leftjoin('customer as c', 'c.id', 'in.customerid')
        ->select('ini.description as inidesc', 'ini.quantity as iniqty', 'ini.rate as inirate', 'ini.cgstvalue', 'ini.sgstvalue', 'ini.cgst', 'ini.sgst', 'ini.taxable', 'in.date as invdate', 'in.id as invid', 'c.name as cusname', 'po.purchaseordernumber as ponumber')
        ->get();

        return view('report.purchase', compact('purchases'));
    }
}
