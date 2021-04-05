<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Carbon\Carbon;
use DB;

class QuotationController extends Controller
{
    public function list(Request $request) {
        $quotes = DB::table('quotation as q')
        ->leftjoin('customer as c', 'c.id', 'q.customerid')
        ->select('q.*', 'c.name as name', 'c.address as address', 'c.phone as phone')
        ->get();

        return view('quotation.list', compact('quotes'));
    }

    public function create(Request $request) {
        $formtype = 'new';
        $customers = DB::table('customer')
        ->where('is_active', '1')
        ->get();

        return view('quotation.form', compact('formtype', 'customers'));
    }

    public function edit(Request $request) {
        $formtype = 'edit';
        $id = $request->id;

        $customers = DB::table('customer')
        ->where('is_active', '1')
        ->get();

        $getquotation = DB::table('quotation')
        ->where('quotationid', $id)
        ->first();

        $quoteitems = DB::table('quotation_items')
        ->where('quotation_id', $id)
        ->get();

        return view('quotation.form', compact('formtype', 'customers', 'getquotation', 'quoteitems'));
    }

    public function postquotation(Request $request) {
        $userid = Auth::id();
        $customer = $request->customer_id;
        $date = $request->date;
        $quotationsaveid = $request->quotationsaveid;
        $minimum = $request->minimum;
        $gst = $request->gst;
        $leadtime = $request->leadtime;
        $validity = $request->validity;

        if(isset($quotationsaveid) && !empty($quotationsaveid)) {
            $update = DB::table('quotation')
            ->where('quotationid', $quotationsaveid)
            ->update([
                'customerid' => $customer,
                'date' => $date,
                'minimum' => $minimum,
                'gstpercent' => $gst,
                'leadtime' => $leadtime,
                'validity' => $validity,
                'userid' => $userid,
                'updated_at' => now(),
            ]);

            $itemscount = count(collect($request)->get('description'));
            
            if($itemscount > 0) {
                $deleteitems = DB::table('quotation_items')
                ->where('quotation_id', $quotationsaveid)
                ->delete();
                for ($i = 0; $i < $itemscount; $i++) {
                    $insertnewitems = DB::table('quotation_items')
                    ->insert([
                        'quotation_id' => $quotationsaveid,
                        'description' => request('description')[$i],
                        'quantity' => request('quantity')[$i],
                        'rate' => request('rate')[$i],
                        'date' => now()
                    ]);
                }
            }
        } else {
            $insertid = DB::table('quotation')
            ->insertGetId([
                'customerid' => $customer,
                'date' => $date,
                'minimum' => $minimum,
                'gstpercent' => $gst,
                'leadtime' => $leadtime,
                'validity' => $validity,
                'userid' => $userid,
                'created_at' => now(),
            ]);

            $itemscount = count(collect($request)->get('description'));
            
            if($itemscount > 0) {
                for ($i = 0; $i < $itemscount; $i++) {
                    $insertnewitems = DB::table('quotation_items')
                    ->insert([
                        'quotation_id' => $insertid,
                        'description' => request('description')[$i],
                        'quantity' => request('quantity')[$i],
                        'rate' => request('rate')[$i],
                        'date' => now()
                    ]);
                }
            }
        }
        $data = ['code' => '200', 'status' => 'success', 'message' => 'Quotation created successfully'];
        return back()->with($data);
    }

    public function quotationstatus(Request $request) {
        $id = $request->id;
        $status = $request->status;

        $updatestatus = DB::table('quotation')
        ->where('quotationid', $id)
        ->update([
            'is_active' => $status
        ]);
        $data = ['code' => '200', 'status' => 'success', 'message' => 'Quotation '.$id.' status updated successfully'];
        return back()->with($data);
    }

    public function getquotation(Request $request) {
        $id = $request->id;

        $quotation = DB::table('quotation as q')
        ->leftjoin('customer as c', 'c.id', 'q.customerid')
        ->where('quotationid', $id)
        ->select('q.*', 'c.*')
        ->first();

        $quoteitems = DB::table('quotation_items')
        ->where('quotation_id', $id)
        ->get();
        
        $setting = DB::table('settings')
        ->first();

        if(isset($quotation)&&!empty($quotation)) {
            return view('quotation.view', compact('quotation', 'quoteitems', 'setting'));
        } else {
            abort('404');
        }
    }
}
