<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Carbon\Carbon;
use DB;

class InvoiceController extends Controller
{
    public function list(Request $request) {
        $invoices = DB::table('invoice as in')
        ->leftjoin('customer as c', 'c.id', 'in.customerid')
        ->leftjoin('purchase_orders as po', 'po.id', 'in.pono')
        ->leftjoin('users as u', 'u.id', 'in.userid')
        ->select('in.*', 'in.date as invoicedate', 'c.address as customeraddress', 'c.phone as customerphone', 'c.name as customername', 'po.purchaseordernumber as purchaseordernumber', 'po.purchaseorderdate as purchaseorderdate', 'u.name as user', DB::raw("(select sum(amount) from accounts where refid = in.id) as paidamount"))
        ->get();
        return view('invoice.list', compact('invoices'));
    }

    public function create(Request $request) {
        $formtype = 'new';
        $purchaseorders = DB::table('purchase_orders as po')
        
        ->get();

        return view('invoice.create', compact('formtype', 'purchaseorders'));
    }

    public function postinvoice(Request $request) {
        $userid = Auth::id();
        
        $invoicesaveid = $request->invoicesaveid;
        $purchaseorderid = $request->purchaseorderid;
        $deliverynote = $request->deliverynote;
        $supplierrefno = $request->supplierrefno;
        $otherreferences = $request->otherreferences;
        $dispatchdocno = $request->dispatchdocno;
        $deliverynotedate = $request->deliverynotedate;
        $dispatchedthrough = $request->dispatchedthrough;
        $destination = $request->destination;
        $termsofdelivery = $request->termsofdelivery;
        $taxtotal = $request->taxtotal;
        $gst = $request->gst;
        $subtotal = $request->subtotal;
        $grandtotal = $request->grandtotal;

        $povalue = DB::table('purchase_orders as po')
        ->leftjoin('customer as c', 'c.id', 'po.customer_id')
        ->where('po.id', $purchaseorderid)
        ->select('po.*', 'c.*')
        ->first();

        if(isset($invoicesaveid) && !empty($invoicesaveid)) {
            $updateinvoice = DB::table('invoice')
            ->where('id', $invoicesaveid)
            ->update([
                'pono' => $purchaseorderid,
                'customerid' => $povalue->customer_id,
                'customerpono' => $povalue->purchaseordernumber,
                'deliverynote' => $deliverynote,
                'supplierrefno' => $supplierrefno,
                'otherreferences' => $otherreferences,
                'dispatchdocno' => $dispatchdocno,
                'deliverynotedate' => $deliverynotedate,
                'dispatchedthrough' => $dispatchedthrough,
                'destination' => $destination,
                'termsofdelivery' => $termsofdelivery,
                'subtotal' => $subtotal,
                'taxable' => $taxtotal,
                //'gst' => $gst,
                'totalamount' => $grandtotal,
                'userid' => $userid,
                'updated_at' => Carbon::now()
            ]);
            $itemscount = count(collect($request)->get('description'));
            $deactivateinvoiceitems = DB::table('invoice_items')
                ->where('invoiceid', $invoicesaveid)
                ->update(['is_active' => '0']);
            if($itemscount > 0) {
                for ($i = 0; $i < $itemscount; $i++) {
                    $insertnewitems = DB::table('invoice_items')
                    ->insert([
                        'invoiceid' => $invoicesaveid,
                        'description' => request('description')[$i],
                        'hsnsac' => request('hsnsac')[$i],
                        'quantity' => request('quantity')[$i],
                        'unit' => request('unit')[$i],
                        'rate' => request('rate')[$i],
                        'discount' => request('discount')[$i],
                        'amount' => request('amount')[$i],
                        'taxable' => request('taxable')[$i],
                        'cgst' => request('cgst')[$i],
                        'sgst' => request('sgst')[$i],
                        'igst' => request('igst')[$i],
                        'cgstvalue' => request('cgstvalue')[$i],
                        'sgstvalue' => request('sgstvalue')[$i],
                        'igstvalue' => request('igstvalue')[$i],
                    ]);
                }
            }
        } else {
            $insertinvoiceid = DB::table('invoice')
            ->insertGetId([
                'pono' => $purchaseorderid,
                'customerid' => $povalue->customer_id,
                'customerpono' => $povalue->purchaseordernumber,
                'deliverynote' => $deliverynote,
                'supplierrefno' => $supplierrefno,
                'otherreferences' => $otherreferences,
                'dispatchdocno' => $dispatchdocno,
                'deliverynotedate' => $deliverynotedate,
                'dispatchedthrough' => strtoupper($dispatchedthrough),
                'destination' => $destination,
                'termsofdelivery' => $termsofdelivery,
                'date' => Carbon::now(),
                'subtotal' => $subtotal,
                'taxable' => $taxtotal,
                //'gst' => $gst,
                'totalamount' => $grandtotal,
                'userid' => $userid,
                'created_at' => Carbon::now()
            ]);
            $itemscount = count(collect($request)->get('description'));
            if($itemscount > 0) {
                for ($i = 0; $i < $itemscount; $i++) {
                    $reqqty = request('quantity')[$i];
                    //return $reqqty;
                    $insertnewitems = DB::table('invoice_items')
                    ->insert([
                        'invoiceid' => $insertinvoiceid,
                        'description' => request('description')[$i],
                        'hsnsac' => request('hsnsac')[$i],
                        'quantity' => request('quantity')[$i],
                        'unit' => request('unit')[$i],
                        'rate' => request('rate')[$i],
                        'discount' => request('discount')[$i],
                        'amount' => request('amount')[$i],
                        'taxable' => request('taxable')[$i],
                        'cgst' => request('cgst')[$i],
                        'sgst' => request('sgst')[$i],
                        'igst' => request('igst')[$i],
                        'cgstvalue' => request('cgstvalue')[$i],
                        'sgstvalue' => request('sgstvalue')[$i],
                        'igstvalue' => request('igstvalue')[$i],
                    ]);
                    $poitemid = request('poitemid')[$i];
                    $qty = DB::table('purchase_orders_items')
                    ->where('id', $poitemid)
                    ->first();

                    $updatedelivered = DB::table('purchase_orders_items')
                    ->where('id', $poitemid)
                    ->update([
                        'deliveredqty' => request('quantity')[$i],
                        
                    ]);
                }
            }
        }
        $data = ['code' => '200', 'status' => 'success', 'message' => 'Purchase Order created successfully'];
        return back()->with($data);
    }

    public function edit(Request $request) {
        $id = $request->id;
        $formtype = 'edit';
        $purchaseorders = DB::table('purchase_orders')
        ->where('is_active', '1')
        ->get();

        $getinvoice = DB::table('invoice')
        ->where('id', $id)
        ->first();

        $invoiceitems = DB::table('invoice_items')
        ->where('invoiceid', $id)
        ->where('is_active', '1')
        ->get();

        return view('invoice.create', compact('formtype', 'purchaseorders', 'getinvoice', 'invoiceitems'));
    }

    public function invoicestatus(Request $request) {
        $id = $request->id;
        $status = $request->status;
        $update = DB::table('invoice')->where('id', $id)->update(['is_active' => $status]);
        $data = ['code' => '200', 'status' => 'success', 'message' => 'Successfully updated status'];

        return back()->with($data);
    }

    public function getinvoice(Request $request) {
        $id = $request->id;
        $pid = $request->pid;
        
        $getinvoice = DB::table('invoice as i')
        ->leftjoin('purchase_orders as po', 'po.id', 'i.pono')
        ->leftjoin('customer as c', 'c.id', 'i.customerid')
        ->where('i.id', $id)
        ->where('i.pono', $pid)
        ->select('i.id as invid', 'i.*', 'po.id as poid', 'po.terms_of_payment as terms_of_payment', 'po.purchaseordernumber as purchaseordernumber', 'po.purchaseorderdate as purchaseorderdate', 'c.*')
        ->first();

        $invoiceitems = DB::table('invoice_items as ii')
        ->where('ii.invoiceid', $id)
        ->where('ii.is_active', '1')
        ->get();

        $cgst = $invoiceitems[0]->cgst;
        $sgst = $invoiceitems[0]->sgst;
        $igst = $invoiceitems[0]->igst;

        if($cgst != '0' || $sgst != '0') {
            $taxtype = 'cgst';
        } else if($igst != '0') {
            $taxtype = 'igst';
        } else {
            $taxtype = '';
        }

        $setting = DB::table('settings')->first();

        return view('invoice.view', compact('getinvoice', 'invoiceitems', 'setting', 'taxtype'));
    }
}
