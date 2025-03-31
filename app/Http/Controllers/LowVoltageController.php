<?php

namespace App\Http\Controllers;

use App\Models\LowVoltage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LowVoltageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('form.lowVoltage.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(LowVoltage $lowVoltage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LowVoltage $lowVoltage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LowVoltage $lowVoltage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LowVoltage $lowVoltage)
    {
        //
    }
}
