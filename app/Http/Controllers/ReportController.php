<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function monthlyReport()
    {
        return view('admin.report.month-wise');
    }

    public function monthWiseReport(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $costs = Cost::whereMonth('created_at', $month)->whereYear('created_at', $year)->get();
        if($costs){
            return response()->json($costs);
        }
    }
}
