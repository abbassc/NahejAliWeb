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
    public function assignDonation(Request $request, $donation_id)
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
        'volunteer_id' => $volunteer->user_id,
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

        $totalDonations = Donation::count();
        $completedDonations = Donation::where('status', 'collected')->count();

        return view('admin.dashboard', compact(
            'donors', 
            'volunteers', 
            'pendingDonations', 
            'assignedDonations', 
            'collectedDonations', 
            'families',
            'totalDonations',
            'completedDonations',
        ));
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
        'user_id' => $user->id,
        'name' => $request->name,
        'availability' => $request->availability,
        'location' => $request->location,
        'phone' => $request->phone,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Volunteer added.');
    }

    public function editVolunteer($id)
    {
        $volunteer = User::with('volunteer')->findOrFail($id);
        return view('admin.volunteers.edit', compact('volunteer'));
    }

    public function updateVolunteer(Request $request, $id)
    {
        $volunteer = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|max:20',
            'location' => 'required|string|max:255'
        ]);

        $volunteer->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $volunteer->volunteer->update([
            'phone' => $request->phone,
            'location' => $request->location
        ]);

        return redirect()->route('admin.volunteers.index')
            ->with('success', 'Volunteer updated successfully');
    }

    public function destroyVolunteer($id)
    {
        $volunteer = User::findOrFail($id);
        $volunteer->volunteer->delete();
        $volunteer->delete();

        return redirect()->route('admin.volunteers.index')
            ->with('success', 'Volunteer deleted successfully');
    }

    public function listVolunteers()
    {
        $volunteers = User::where('role', 'volunteer')
            ->with('volunteer')->get();

        return view('admin.volunteers.index', compact('volunteers'));
    }

    public function addVolunteer()
    {
        return view('admin.volunteers.add');
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
            'user_id' => $user->id,
            'location' => $request->location,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Donor added.');
    }

    public function updateDonor(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $donor = Donor::where('user_id', $id)->firstOrFail();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $donor->update([
            'location' => $request->location,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Donor updated.');
    }

    public function deleteDonor($id)
    {
        Donor::where('user_id', $id)->delete();
        User::destroy($id);
        
        return redirect()->route('admin.dashboard')->with('success', 'Donor deleted.');
    }

    public function listDonors()
    {
        $donors = User::where('role', 'donor')
            ->with('donor')->get();

        return view('admin.donors.index', compact('donors'));
    }



    // ----------------- Families -----------------
    public function storeFamily(Request $request)
    {
        Family::create([
            'name' => $request->name,
            'location' => $request->location,
            'phone' => $request->phone,
            'members' => $request->members,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Family added.');
    }

    // public function updateFamily(Request $request, $id)
    // {
    //     $family = Family::findOrFail($id);

    //     $family->update([
    //         'name' => $request->name,
    //         'location' => $request->location,
    //         'phone' => $request->phone,
    //         'members' => $request->members,
    //     ]);

    //     return redirect()->route('admin.dashboard')->with('success', 'Family updated.');
    // }

    // public function deleteFamily($id)
    // {
    //     Family::destroy($id);
        
    //     return redirect()->route('admin.dashboard')->with('success', 'Family deleted.');
    // }

    public function addFamily()
    {
        return view('admin.families.add');
    }

    public function reports()
    {
        $totalDonations = Donation::count();
        $completedDonations = Donation::where('status', 'collected')->count();
        $pendingDonations = Donation::where('status', 'pending')->count();
        $assignedDonations = Donation::where('status', 'assigned')->count();

        $donationsByCategory = Donation::selectRaw('category, count(*) as count')
            ->groupBy('category')
            ->get();

        $donationsByMonth = Donation::selectRaw('MONTH(created_at) as month, count(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->get();

        return view('admin.reports', compact(
            'totalDonations',
            'completedDonations',
            'pendingDonations',
            'assignedDonations',
            'donationsByCategory',
            'donationsByMonth'
        ));
    }

    public function listDonations()
    {
        $donations = Donation::with(['donor.user', 'volunteer.user'])->paginate(10);
        return view('admin.donations.index', compact('donations'));
    }

    public function completeDonation($donation_id)
    {
        $donation = Donation::findOrFail($donation_id);

        if ($donation->status !== 'assigned') {
            return redirect()->back()->with('error', 'Only assigned donations can be completed.');
        }

        $donation->update([
            'status' => 'collected'
        ]);

        return redirect()->route('admin.donations')->with('success', 'Donation marked as completed.');
    }

    public function listFamilies()
    {
        $families = Family::paginate(10);
        return view('admin.families.index', compact('families'));
    }

    public function editFamily($id)
    {
        $family = Family::findOrFail($id);
        return view('admin.families.edit', compact('family'));
    }

    public function updateFamily(Request $request, $id)
    {
        $family = Family::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'members' => 'required|integer|min:1'
        ]);

        $family->update($request->all());

        return redirect()->route('admin.families.index')
            ->with('success', 'Family updated successfully');
    }

    public function deleteFamily($id)
    {
        $family = Family::findOrFail($id);
        $family->delete();

        return redirect()->route('admin.families.index')
            ->with('success', 'Family deleted successfully');
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
