<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Show the homepage or redirect based on user role
    public function index()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'volunteer':
                    return redirect()->route('volunteer.dashboard');
                case 'donor':
                    return redirect()->route('donor.dashboard');
            }
        }
        
        return view('index'); // Public welcome page
    }
}
