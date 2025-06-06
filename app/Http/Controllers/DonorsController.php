<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Donation;


class DonorsController extends Controller
{
     public function dashboard()
    {
        $donor = Auth::user()->donor;

        $donations = Auth::user()->donor->donations()->get();

        $donations = Donation::where('donor_id', Auth::user()->donor->id)->get();

        return view('donor.dashboard', compact('donations'));
    }



    // Store new donation
    public function storeDonation(Request $request)
    {




        $request->validate([
        'date' => 'required|date',
        ]);




        Donation::create([
            'donor_id' => Auth::user()->donor->id,
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
            'category' => $request->category,
            'date' => $request->date,
            'prefered_time' => $request->prefered_time,
            'location' => $request->location,
            'phone' => $request->phone,
            'status' => 'pending',
        ]);

        return redirect()->route('donor.dashboard')->with('success', 'Appointment booked.');
    }



    // Update an donation (from modal)
    public function updateDonation(Request $request, $donation_id)
    {
        $donation = Donation::where('id', $donation_id)
            ->where('donor_id', Auth::user()->donor->id)
            ->firstOrFail();




        $request->validate([
        'date' => 'required|date',
        ]);





        $donation->update([
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
            'category' => $request->category,
            'date' => $request->date,
            'prefered_time' => $request->prefered_time,
            'location' => $request->location,
            'phone' => $request->phone,
        ]);

        return redirect()->route('donor.dashboard')->with('success', 'Donation updated.');
    }

    

    // Cancel donation
    public function cancelDonation($donation_id)
    {
        $donation = Donation::where('id', $donation_id)
            ->where('donor_id', Auth::user()->donor->id)
            ->firstOrFail();

        $donation->delete();

        return redirect()->route('donor.dashboard')->with('success', 'Donation cancelled.');
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
    public function show(donors $donors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(donors $donors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, donors $donors)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(donors $donors)
    {
        //
    }
}
