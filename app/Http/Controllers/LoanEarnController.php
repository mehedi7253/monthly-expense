<?php

namespace App\Http\Controllers;

use App\Models\LoanEarn;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanEarnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loan_earns = LoanEarn::whereMonth('created_at', Carbon::now()->month)->get();
        return view('admin.loan-earn.index', compact('loan_earns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'reason' =>'required',
            'loan_amount' => 'required|numeric',
            'type' => 'required',
        ]);
        LoanEarn::create($request->all());
        return redirect()->route('earn-loans.index')->with('success', 'Added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
