<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounts;
use Redirect;
use Illuminate\Support\Facades\Auth;
use DB;

class AccountsController extends Controller
{
    public function create() {
        $accounts = Accounts::all();
        $data = ['accounts' => $accounts];
        return view('accounts.list')->with($data);
    }

    public function formcreate(Request $request) {
        $formtype = 'new';
        return view('accounts.form', compact('formtype'));
    }

    public function submit(Request $request) {
        $user_id = Auth::id();
        $accountsid = $request->accountsid;

        $type = request('type');
        $date = request('date');
        $source = request('source');
        $refno = request('refno');
        $paymentstatus = request('paymentstatus');
        $totalamount = request('totalamount');
        $amount = request('amount');
        $notes = request('notes');

        if(isset($accountsid) && !empty($accountsid)) {
            $update = DB::table('accounts')
            ->where('id', $accountsid)
            ->update([
                'date' => $date,
                'source' => $source,
                'refid' => $refno,
                'paymentstatus' => $paymentstatus,
                'totalamount' => $totalamount,
                'amount' => $amount,
                'notes' => $notes,
                'updated_at' => now()
            ]);
        } else {
            $insert = DB::table('accounts')
            ->insertGetId([
                'date' => $date,
                'type' => $type,
                'source' => $source,
                'refid' => $refno,
                'paymentstatus' => $paymentstatus,
                'totalamount' => $totalamount,
                'amount' => $amount,
                'notes' => $notes,
                'added_by' => $user_id,
                'created_at' => now()
            ]);
        }
        
        $data = ['message' => "Successfully added account data", 'status' => 'success', 'code' => '200'];

        return back()->with($data);
    }

    public function accountStatus($id, $status) {
        $update = Accounts::where('id', $id)->update(['is_active' => $status]);

        if($update) {
            $data = ['code' => '200', 'status' => 'success', 'message' => 'Successfully updated account'];
        } else {
            $data = ['code' => '100', 'status' => 'failure', 'message' => 'Something went wrong. Try again later'];
        }

        return back()->with($data);
    }

    public function editCreate(Request $request) {
        $id = $request->id;
        $formtype = 'edit';
        $getaccounts = Accounts::where('id', $id)->first();

        return view('accounts.form', compact('formtype', 'getaccounts'));
    }
}
