<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationsController extends Controller
{

    public function createDonation()
    {
        return view('new-donation');
    }

    // Store new donation
    public function storeDonation(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'prefered_time' => 'required|date',
            'location' => 'required|string',
            'phone' => 'required|string',
            'title' => 'required|string',
            'category' => 'required|string',
            'amount' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $donation = Donation::create([
            'title' => $request->title,
            'category' => $request->category,
            'amount' => $request->amount,
            'description' => $request->description,
            'location' => $request->location,
            'phone' => $request->phone,
            'date' => $request->date,
            'prefered_time' => $request->prefered_time,
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Donation submitted successfully!');
    }







    
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(donations $donations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(donations $donations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, donations $donations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(donations $donations)
    {
        //
    }
}
