<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string'],
            'location' => ['required', 'string'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->has('availability') ? 'volunteer' : 'donor', // Set role based on form type
        ]);

        // Create corresponding role record
        if ($user->role === 'volunteer') {
            \App\Models\Volunteer::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'availability' => $request->availability,
                'location' => $request->location,
                'phone' => $request->phone,
            ]);
        } else {
            \App\Models\Donor::create([
                'user_id' => $user->id,
                'location' => $request->location,
                'phone' => $request->phone,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route($user->role . '.dashboard', absolute: false));
    }
}
