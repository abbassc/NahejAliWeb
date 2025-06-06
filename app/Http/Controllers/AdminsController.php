<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Volunteer;
use App\Models\User;
use App\Models\Family;

class AdminsController extends Controller
{
    public function assignDonation(/**/Request $request,/**/      $donation_id,    /*$volunteer_id*/)
    {
        $donation = Donation::findOrFail($donation_id);
        ///////////////////////////////
        
        ///////////////////////////////
        //$volunteer = Volunteer::findOrFail($volunteer_id);
        $volunteer = Volunteer::findOrFail($request->input('volunteer_id'));

        if ($donation->status == 'assigned') {
            return redirect()->back()->with('error', 'Donation already assigned.');
        }
        if ($donation->status == 'collected') {
            return redirect()->back()->with('error', 'Donation already collected.');
        }

        $donation->update([
        'status' => 'assigned',
        'volunteer_id' => /*$volunteer_id*/ $volunteer->id,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Donation assigned.');
    }



    // ----------------- Dashboard -----------------
    public function dashboard()
    {
        $donors = Donor::with('user')->get();
        $volunteers = Volunteer::with('user')->get();

        $pendingDonations = Donation::where('status', 'pending')->get();
        $assignedDonations = Donation::where('status', 'assigned')->with('volunteer.user')->get();
        $collectedDonations = Donation::where('status', 'collected')->with('volunteer.user')->get();

        $families = Family::get();

        return view('admin.dashboard', compact('donors', 'volunteers', 'pendingDonations', 'assignedDonations', 'collectedDonations', 'families'));
    }



    // ----------------- VolunteerS -----------------
    public function storeVolunteer(Request $request)
    {
        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt('password'),
        'role' => 'volunteer',
        ]);

        Volunteer::create([
        'id' => $user->id,
        'availability' => $request->availability,
        'location' => $request->location,
        'phone' => $request->phone,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Volunteer added.');
    }

    public function updateVolunteer(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $volunteer = Volunteer::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $volunteer->update([
        'availability' => $request->availability,
        'location' => $request->location,
        'phone' => $request->phone,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Volunteer updated.');
    }

    public function deleteVolunteer($id)
    {
        Volunteer::destroy($id);
        User::destroy($id);

        return redirect()->route('admin.dashboard')->with('success', 'Volunteer deleted.');
    }



    // ----------------- Donors -----------------
    public function storeDonor(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password'),
            'role' => 'donor',
        ]);

        Donor::create([
            'id' => $user->id,
            'location' => $request->location,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Donor added.');
    }

    public function updateDonor(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $donor = Donor::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $donor->update([
            'dob' => $request->dob,
            'location' => $request->location,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Donor updated.');
    }

    public function deleteDonor($id)
    {
        Donor::destroy($id);
        User::destroy($id);
        
        return redirect()->route('admin.dashboard')->with('success', 'Donor deleted.');
    }



    // ----------------- Families -----------------
    public function storeFamily(Request $request)
    {
        Family::create([
            'location' => $request->location,
            'phone' => $request->phone,
            'members' => $request->members,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Family added.');
    }

    public function updateFamily(Request $request, $id)
    {
        $family = Family::findOrFail($id);

        $family->update([
            'location' => $request->location,
            'phone' => $request->phone,
            'members' => $request->members,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Family updated.');
    }

    public function deleteFamily($id)
    {
        Family::destroy($id);
        
        return redirect()->route('admin.dashboard')->with('success', 'Family deleted.');
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
    public function show(admins $admins)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(admins $admins)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, admins $admins)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(admins $admins)
    {
        //
    }
}
