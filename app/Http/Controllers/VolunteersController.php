<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Donation;
use App\Models\Volunteer;


class VolunteersController extends Controller
{
    public function dashboard()
    {
        $donations = Auth::user()->volunteer->donations()->get();

        $availableDonations = Donation::where('status', 'pending')->get();
        $tasksDonations = Donation::where('volunteer_id', Auth::user()->volunteer->id)->where('status', 'assigned')->get();
        $completedDonations = Donation::where('volunteer_id', Auth::user()->volunteer->id)->where('status', 'collected')->get();

        return view('volunteer.dashboard', compact('donations', 'availableDonations', 'tasksDonations', 'completedDonations'));
    }


    // Reserve donation
    public function reserveDonation($donation_id)
    {
        $donation = Donation::where('id', $donation_id)->firstOrFail();

        if ($donation->status == 'assigned') {
            return redirect()->back()->with('error', 'Donation already assigned.');
        }
        if ($donation->status == 'collected') {
            return redirect()->back()->with('error', 'Donation already collected.');
        }

        // $donation->update(['status' => 'assigned']);
        // $donation->update(['volunteer_id' => Auth::user()->volunteer->id]);
        $donation->update(['status' => 'assigned', 'volunteer_id' => Auth::user()->volunteer->id,]);


        return redirect()->route('volunteer.dashboard')->with('success', 'Donation reserved.');
    }


    // Collect donation
    public function collectDonation($donation_id)
    {
        $donation = Donation::where('id', $donation_id)->where('volunteer_id', Auth::user()->volunteer->id)->firstOrFail();

        if ($donation->status !== 'assigned') {
            return redirect()->back()->with('error', 'Donation is not assigned yet.');
        }
        if ($donation->status == 'collected') {
            return redirect()->back()->with('error', 'Donation already collected.');
        }

        $donation->update(['status' => 'collected']);

        return redirect()->route('volunteer.dashboard')->with('success', 'Donation collected.');
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
    public function show(volunteers $volunteers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(volunteers $volunteers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, volunteers $volunteers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(volunteers $volunteers)
    {
        //
    }
}
