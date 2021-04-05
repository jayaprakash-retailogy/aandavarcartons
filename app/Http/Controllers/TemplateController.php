<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\JobCard;
use App\Models\JobCardPly;
use App\Models\UserModel;
use App\Models\PurchaseOrders;
use App\Models\PurchaseOrdersItems;
use Redirect;
use Carbon\Carbon;
use DB;

class TemplateController extends Controller
{
    public function jobcardtemplate(Request $request) {
        $id = $request->id;
        $jobcard = JobCard::where('id', $id)->first();
        $jobcard_ply = JobCardPly::where('jobcard_id', $id)->where('is_active', '1')->get();
        $purchaseorders = PurchaseOrders::where('is_active', '1')->where('id', $jobcard->purchase_order_id)->first();
        $purchaseorderitems = DB::table('purchase_orders_items')->where('purchase_orders_id', $purchaseorders->id)->where('is_active', '1')->get();
        $customers = Customer::where('id', $purchaseorders->customer_id)->first();
        $data = ['jobcard' => $jobcard, 'jobcard_ply' => $jobcard_ply, 'purchaseorders' => $purchaseorders, 'customers' => $customers, 'purchaseorderitems' => $purchaseorderitems];

        return view('templates.jobcard')->with($data);
    }
}
