<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\LoanEarn;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $month   = Carbon::today();
        $earning = LoanEarn::select('*')->whereMonth('created_at', Carbon::now()->month)->where('type', 'earn')->SUM('loan_amount');
        $loan    = LoanEarn::select('*')->whereMonth('created_at', Carbon::now()->month)->where('type', 'loan')->SUM('loan_amount');
        $cost    = Cost::select('*')->whereMonth('created_at', Carbon::now()->month)->SUM('amount');

        return view('home', compact('month', 'earning','loan', 'cost'));
    }
}
