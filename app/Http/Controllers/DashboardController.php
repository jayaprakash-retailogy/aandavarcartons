<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobCard;
use App\Models\Customer;
use App\Models\Accounts;
use App\Models\PurchaseOrders;
use DB;

class DashboardController extends Controller
{
    public function create() {
        $year = date("Y");
        $purchaseorders = PurchaseOrders::where('is_active', '1')->orderBy('id','ASC')->limit(5)->get();
        $customers = Customer::with('pocustomers')->get();

        $totalvalue = DB::table('invoice as in')
        ->select(DB::raw('SUM(in.totalamount) as total_sales'))
        ->first();

        $salesvalues = DB::table('invoice as in')
        ->select('in.totalamount as sales')
        ->orderBy('id', 'ASC')
        ->limit(10)
        ->get();

        $salesvalue = [];
        foreach($salesvalues as $sv) {
            array_push($salesvalue, $sv->sales);
        }
        
        $transactions = Accounts::orderBy('id','DESC')->take(5)->get();
        
        $total_income = Accounts::whereYear('date',$year)
        ->where('type','1')
        ->selectRaw('year(date) year, SUM(amount) as amount')
        ->groupBy('year')
        ->orderBy('year', 'asc')
        ->first(); 
        $total_expense = Accounts::whereYear('date',$year)
        ->where('type','2')
        ->selectRaw('year(date) year, SUM(amount) as amount')
        ->groupBy('year')
        ->orderBy('year', 'asc')
        ->first(); 

        $jan_income = Accounts::whereMonth('date','1')
        ->whereYear('date',$year)
        ->where('type','1')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first(); 
        $feb_income = Accounts::whereMonth('date','2')
        ->whereYear('date',$year)
        ->where('type','1')
        ->selectRaw('monthname(date) month,  SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first(); 
        $mar_income = Accounts::whereMonth('date','3')
        ->whereYear('date',$year)
        ->where('type','1')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first();
        $apr_income = Accounts::whereMonth('date','4')
        ->whereYear('date',$year)
        ->where('type','1')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first();
        $may_income = Accounts::whereMonth('date','5')
        ->whereYear('date',$year)
        ->where('type','1')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first(); 
        $jun_income = Accounts::whereMonth('date','6')
        ->whereYear('date',$year)
        ->where('type','1')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first();
        $jul_income = Accounts::whereMonth('date','7')
        ->whereYear('date',$year)
        ->where('type','1')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first(); 
        $aug_income = Accounts::whereMonth('date','8')
        ->whereYear('date',$year)
        ->where('type','1')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first();
        $sep_income = Accounts::whereMonth('date','9')
        ->whereYear('date',$year)
        ->where('type','1')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first(); 
        $oct_income = Accounts::whereMonth('date','10')
        ->whereYear('date',$year)
        ->where('type','1')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first();
        $nov_income = Accounts::whereMonth('date','11')
        ->whereYear('date',$year)
        ->where('type','1')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first();
        $dec_income = Accounts::whereMonth('date','12')
        ->whereYear('date',$year)
        ->where('type','1')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first();
        
        if($jan_income == null)
        $jan_income = "0"; 
        else 
        $jan_income =  $jan_income->amount;        
        if($feb_income == null)
        $feb_income = "0";
        else 
        $feb_income=  $feb_income->amount;
        if($mar_income == null)
        $mar_income = "0";
        else 
        $mar_income =  $mar_income->amount;
        if($apr_income == null)
        $apr_income = "0";
        else 
        $apr_income =  $apr_income->amount;
        if($may_income == null)
        $may_income = "0";
        else 
        $may_income =  $may_income->amount;
        if($jun_income == null)
        $jun_income = "0";
        else 
        $jun_income =  $jun_income->amount;
        if($jul_income == null)
        $jul_income = "0";
        else 
        $jul_income =  $jul_income->amount;
        if($aug_income == null)
        $aug_income = "0";
        else 
        $aug_income =  $aug_income->amount;
        if($sep_income == null)
        $sep_income = "0";
        else 
        $sep_income =  $sep_income->amount;
        if($oct_income == null)
        $oct_income = "0";
        else 
        $oct_income =  $oct_income->amount;
        if($nov_income == null)
        $nov_income = "0";
        else 
        $nov_income =  $nov_income->amount;
        if($dec_income == null)
        $dec_income = "0";
        else
        $dec_income = $dec_income->amount;
        $income = [$jan_income,$feb_income,$mar_income,$apr_income,$may_income,$jun_income,$jul_income,$aug_income,$sep_income,$oct_income,$nov_income,$dec_income];

        $jan_expense = Accounts::whereMonth('date','1')
        ->whereYear('date',$year)
        ->where('type','2')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first(); 
        $feb_expense = Accounts::whereMonth('date','2')
        ->whereYear('date',$year)
        ->where('type','2')
        ->selectRaw('monthname(date) month,  SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first(); 
        $mar_expense = Accounts::whereMonth('date','3')
        ->whereYear('date',$year)
        ->where('type','2')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first();
        $apr_expense = Accounts::whereMonth('date','4')
        ->whereYear('date',$year)
        ->where('type','2')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first();
        $may_expense = Accounts::whereMonth('date','5')
        ->whereYear('date',$year)
        ->where('type','2')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first(); 
        $jun_expense = Accounts::whereMonth('date','6')
        ->whereYear('date',$year)
        ->where('type','2')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first();
        $jul_expense = Accounts::whereMonth('date','7')
        ->whereYear('date',$year)
        ->where('type','2')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first(); 
        $aug_expense = Accounts::whereMonth('date','8')
        ->whereYear('date',$year)
        ->where('type','2')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first();
        $sep_expense = Accounts::whereMonth('date','9')
        ->whereYear('date',$year)
        ->where('type','2')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first(); 
        $oct_expense = Accounts::whereMonth('date','10')
        ->whereYear('date',$year)
        ->where('type','2')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first();
        $nov_expense = Accounts::whereMonth('date','11')
        ->whereYear('date',$year)
        ->where('type','2')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first();
        $dec_expense = Accounts::whereMonth('date','12')
        ->whereYear('date',$year)
        ->where('type','2')
        ->selectRaw('monthname(date) month, SUM(amount) as amount')
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->first();
        
        if($jan_expense == null)
        $jan_expense = "0"; 
        else 
        $jan_expense =  $jan_expense->amount;        
        if($feb_expense == null)
        $feb_expense = "0";
        else 
        $feb_expense=  $feb_expense->amount;
        if($mar_expense == null)
        $mar_expense = "0";
        else 
        $mar_expense =  $mar_expense->amount;
        if($apr_expense == null)
        $apr_expense = "0";
        else 
        $apr_expense =  $apr_expense->amount;
        if($may_expense == null)
        $may_expense = "0";
        else 
        $may_expense =  $may_expense->amount;
        if($jun_expense == null)
        $jun_expense = "0";
        else 
        $jun_expense =  $jun_expense->amount;
        if($jul_expense == null)
        $jul_expense = "0";
        else 
        $jul_expense =  $jul_expense->amount;
        if($aug_expense == null)
        $aug_expense = "0";
        else 
        $aug_expense =  $aug_expense->amount;
        if($sep_expense == null)
        $sep_expense = "0";
        else 
        $sep_expense =  $sep_expense->amount;
        if($oct_expense == null)
        $oct_expense = "0";
        else 
        $oct_expense =  $oct_expense->amount;
        if($nov_expense == null)
        $nov_expense = "0";
        else 
        $nov_expense =  $nov_expense->amount;
        if($dec_expense == null)
        $dec_expense = "0";
        else
        $dec_expense = $dec_expense->amount;
        
        if (!$total_income || !$total_expense)
        {
        $total_profit = 0;
        $total_income = 0;
        $total_expense = 0;
        }
        else
        {
        $total_profit = $total_income->amount - $total_expense->amount;
        }

        $expense = [$jan_expense,$feb_expense,$mar_expense,$apr_expense,$may_expense,$jun_expense,$jul_expense,$aug_expense,$sep_expense,$oct_expense,$nov_expense,$dec_expense];

        return view('dashboard', compact('purchaseorders', 'customers', 'transactions', 'income', 'expense', 'total_profit', 'total_income', 'total_expense', 'totalvalue', 'salesvalue'));
    }
}
