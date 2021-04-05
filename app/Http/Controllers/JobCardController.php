<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\JobCard;
use App\Models\JobCardPly;
use App\Models\UserModel;
use App\Models\PurchaseOrders;
use Redirect;
use Carbon\Carbon;
use DB;

class JobCardController extends Controller
{
    public function create() {
        $customers = Customer::where('is_active', '1')->get();
        
        return view('jobcard.new', compact('customers'));
    }

    public function postjobcard(Request $request) {
        $id = $request->id;
        $user_id = Auth::id();
        $timestamp = Carbon::now()->timestamp;
        $created_date = Carbon::now()->toDateTimeString();

        $customer_id = request('customer_id');
        $length_mm = request('length_mm');
        $breadth_mm = request('breadth_mm');
        $height_mm = request('height_mm');
        $length_in = request('length_in');
        $breadth_in = request('breadth_in');
        $height_in = request('height_in');
        $req_reel_size = request('req_reel_size');
        $cutting_length_one_side = request('cutting_length_one_side');
        $cutting_length_two_side = request('cutting_length_two_side');
        $area_sq_inches = request('area_sq_inches');
        $area_sq_meters = request('area_sq_meters');
        $box_weight = request('box_weight');
        $total_paper_cost = request('total_paper_cost');
        $conversion_cost = request('conversion_cost');
        $overall_cost = request('overall_cost');
        $printing_cost = request('printing_cost');
        $total = request('total');

        $bcsaveid = request('bcsaveid');

        if(isset($bcsaveid) && !empty($bcsaveid)) {
            $jobcard = JobCard::find($id);
            $jobcard->length_mm = $length_mm;
            $jobcard->breadth_mm = $breadth_mm;
            $jobcard->height_mm = $height_mm;
            $jobcard->length_in = $length_in;
            $jobcard->breadth_in = $breadth_in;
            $jobcard->height_in = $height_in;
            $jobcard->req_reel_size = $req_reel_size;
            $jobcard->cutting_length_one_side = $cutting_length_one_side;
            $jobcard->cutting_length_two_side = $cutting_length_two_side;
            $jobcard->area_sq_inches = $area_sq_inches;
            $jobcard->area_sq_meters = $area_sq_meters;
            $jobcard->box_weight = $box_weight;
            $jobcard->total_paper_cost = $total_paper_cost;
            $jobcard->conversion_cost = $conversion_cost;
            $jobcard->overall_cost = $overall_cost;
            $jobcard->printing_cost = $printing_cost;
            $jobcard->total = $total;

            if($jobcard->save()) {
                //$jobcard_id = $jobcard->id;
            } else {
                $data = ['code' => '101', 'status' => 'failure', 'message' => 'Job card update failed. Try again later'];
            }

            $delete = DB::table('jobcard_ply')
            ->where('jobcard_id', $id)
            ->delete();

            $ply_count = count(collect($request)->get('ply_no'));

            for ($i = 0; $i < $ply_count; $i++) {
                $ts = Carbon::now()->timestamp;
                $jobcard_ply = new JobCardPly();

                $jobcard_ply->jobcard_id = $id;
                $jobcard_ply->ply_no = request('ply_no')[$i];
                $jobcard_ply->paper_rate = request('paper_rate')[$i];
                $jobcard_ply->paper_bf = request('paper_bf')[$i];
                $jobcard_ply->gsm_of_paper = request('gsm_of_paper')[$i];
                $jobcard_ply->gsm = request('gsm')[$i];
                $jobcard_ply->gsm_calculation = request('gsm_calculation')[$i];
                $jobcard_ply->paper_cost = request('paper_cost')[$i];
                $jobcard_ply->user_id = $user_id;
                $jobcard_ply->timestamp = $ts;

                $jobcard_ply->save();
            }

            if($ply_count == $i) {
                $data = ['code' => '200', 'status' => 'success', 'message' => 'Successfully updated Job Card'];
            } else {
                $data = ['code' => '101', 'status' => 'failure', 'message' => 'Something went wrong. Try again later'];
            }

        } else {
            $jobcard = new JobCard();
            $jobcard->customer_id = $customer_id;
            $jobcard->length_mm = $length_mm;
            $jobcard->breadth_mm = $breadth_mm;
            $jobcard->height_mm = $height_mm;
            $jobcard->length_in = $length_in;
            $jobcard->breadth_in = $breadth_in;
            $jobcard->height_in = $height_in;
            $jobcard->req_reel_size = $req_reel_size;
            $jobcard->cutting_length_one_side = $cutting_length_one_side;
            $jobcard->cutting_length_two_side = $cutting_length_two_side;
            $jobcard->area_sq_inches = $area_sq_inches;
            $jobcard->area_sq_meters = $area_sq_meters;
            $jobcard->box_weight = $box_weight;
            $jobcard->total_paper_cost = $total_paper_cost;
            $jobcard->conversion_cost = $conversion_cost;
            $jobcard->overall_cost = $overall_cost;
            $jobcard->printing_cost = $printing_cost;
            $jobcard->total = $total;
            $jobcard->user_id = $user_id;
            $jobcard->timestamp = $timestamp;
            $jobcard->created_date = $created_date;

            if($jobcard->save()) {
                $jobcard_id = $jobcard->id;
            } else {
                $data = ['code' => '101', 'status' => 'failure', 'message' => 'Job card save failed. Try again later'];
            }

            $ply_count = count(collect($request)->get('ply_no'));

            for ($i = 0; $i < $ply_count; $i++) {
                $ts = Carbon::now()->timestamp;
                $jobcard_ply = new JobCardPly();

                $jobcard_ply->jobcard_id = $jobcard_id;
                $jobcard_ply->ply_no = request('ply_no')[$i];
                $jobcard_ply->paper_rate = request('paper_rate')[$i];
                $jobcard_ply->paper_bf = request('paper_bf')[$i];
                $jobcard_ply->gsm_of_paper = request('gsm_of_paper')[$i];
                $jobcard_ply->gsm = request('gsm')[$i];
                $jobcard_ply->gsm_calculation = request('gsm_calculation')[$i];
                $jobcard_ply->paper_cost = request('paper_cost')[$i];
                $jobcard_ply->user_id = $user_id;
                $jobcard_ply->timestamp = $ts;

                $jobcard_ply->save();
            }

            if($ply_count == $i) {
                $data = ['code' => '200', 'status' => 'success', 'message' => 'Successfully Created Job Card'];
            } else {
                $data = ['code' => '101', 'status' => 'failure', 'message' => 'Something went wrong. Try again later'];
            }
        }
        
        return back()->with($data);
    }

    public function allCreate(Request $request) {
        $calculations = DB::table('jobcard as jc')
        ->leftjoin('customer as c', 'c.id', 'jc.customer_id')
        ->select('jc.*', 'c.*')
        ->get();
        
        return view('jobcard.allJobcard', compact('calculations'));
    }

    public function jobcardStatus(Request $request) {
        $id = $request->id;
        $status = $request->status;
        $update = JobCard::where('id', $id)->update(['is_active' => $status]);

        if($update) {
            $data = ['code' => '200', 'status' => 'success', 'message' => 'Successfully updated Jobcard'];
        } else {
            $data = ['code' => '100', 'status' => 'failure', 'message' => 'Something went wrong. Try again later'];
        }

        return back()->with($data);
    }
    
    public function editCreate(Request $request) {
        $id = $request->id;
        $customers = Customer::where('is_active', '1')->get();
        $getbc = JobCard::where('id', $id)->first();
        $bcitems = JobCardPly::where('jobcard_id', $id)->where('is_active', '1')->get();

        return view('jobcard.new', compact('customers', 'getbc', 'bcitems'));;
    }

    public function jobcardProgressStatus($id, $status) {
        $update = JobCard::where('id', $id)->update(['status' => $status]);

        if($update) {
            $data = ['code' => '200', 'status' => 'success', 'message' => 'Successfully updated Jobcard Status'];
        } else {
            $data = ['code' => '100', 'status' => 'failure', 'message' => 'Something went wrong. Try again later'];
        }

        return back()->with($data);
    }

    public function getpoitems($id) {
        $poitems = DB::table('purchase_orders_items')->where("purchase_orders_id",$id)->get();

        return json_encode($poitems);
    }

    public function getstock($id) {
        $stock = DB::table('roll_stock')->where("purchase_order_id",$id)->get();

        return json_encode($stock);
    }
}
