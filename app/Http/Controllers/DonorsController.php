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
        $donations = Donation::where('donor_id', Auth::user()->donor->user_id)->get();

        return view('donor.dashboard', compact('donor', 'donations'));
    }



    // Store new donation
    public function storeDonation(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'required|in:money,food,clothes',
                'amount' => 'nullable|numeric',
                'description' => 'nullable|string',
                'location' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'prefered_time' => 'required|date',
            ]);

            $donation = Donation::create([
                'donor_id' => Auth::user()->donor->user_id,
                'title' => $request->title,
                'category' => $request->category,
                'amount' => $request->amount,
                'description' => $request->description,
                'location' => $request->location,
                'phone' => $request->phone,
                'prefered_time' => $request->prefered_time,
                'status' => 'pending'
            ]);

            return redirect()->route('donor.dashboard')->with('success', 'Donation created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating donation: ' . $e->getMessage());
        }
    }



    // Update an donation (from modal)
    public function updateDonation(Request $request, $donation_id)
    {
        try {
            $donation = Donation::where('id', $donation_id)
                ->where('donor_id', Auth::user()->donor->user_id)
                ->firstOrFail();

            $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'required|in:money,food,clothes',
                'amount' => 'nullable|numeric',
                'description' => 'nullable|string',
                'location' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'prefered_time' => 'required|date',
            ]);

            $donation->update([
                'title' => $request->title,
                'description' => $request->description,
                'amount' => $request->amount,
                'category' => $request->category,
                'prefered_time' => $request->prefered_time,
                'location' => $request->location,
                'phone' => $request->phone,
            ]);

            return redirect()->route('donor.dashboard')->with('success', 'Donation updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating donation: ' . $e->getMessage());
        }
    }

    

    // Cancel donation
    public function cancelDonation($donation_id)
    {
        try {
            $donation = Donation::where('id', $donation_id)
                ->where('donor_id', Auth::user()->donor->user_id)
                ->firstOrFail();

            $donation->delete();

            return redirect()->route('donor.dashboard')->with('success', 'Donation cancelled successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error cancelling donation: ' . $e->getMessage());
        }
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
