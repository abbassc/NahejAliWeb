<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonorsController;
use App\Http\Controllers\VolunteersController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\DonationsController;
//use App\Http\Controllers\NewDonationController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Auth;
//use App\Http\Middleware\Role;

Route::get('/', [HomeController::class, 'index'])->name('home');
// Create donation as guest
Route::get('/donations/create', [DonationsController::class, 'createDonation'])->name('guest.donations.create');
// Submit (Store) new donation as guest
Route::post('/donations', [DonationsController::class, 'storeDonation'])->name('guest.donations.store');

Route::get('/dashboard', function () {
    if (Auth::check()) {
        return redirect()->route(Auth::user()->role . '.dashboard');
    }
    return redirect()->route('login');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');



Route::middleware(['auth', \App\Http\Middleware\Role::class.':donor'])->prefix('donor')->group(function () {
    Route::get('/dashboard', [DonorsController::class, 'dashboard'])->name('donor.dashboard');
    // View own donations
    Route::get('/donations', [DonorsController::class, 'donations'])->name('donor.donations');
    // Add donation (form)
    Route::get('/donations/add', [DonorsController::class, 'addDonation'])->name('donor.donations.add');
    // Submit (Store) new donation
    Route::post('/donations', [DonorsController::class, 'storeDonation'])->name('donor.donations.store');
    // Update Donation (Submitted from Modal)
    Route::put('/donations/{id}', [DonorsController::class, 'updateDonation'])->name('donor.donations.update');
    // Cancel donation
    Route::delete('/donations/{id}', [DonorsController::class, 'cancelDonation'])->name('donor.donations.cancel');
});



Route::middleware(['auth', \App\Http\Middleware\Role::class.':volunteer'])->prefix('volunteer')->group(function () {
    Route::get('/dashboard', [VolunteersController::class, 'dashboard'])->name('volunteer.dashboard');
    // View assigned/reserved donations
    Route::get('/donations', [VolunteersController::class, 'donations'])->name('volunteer.donations');
    // reserve donation
    Route::post('/donations/{id}/reserve', [VolunteersController::class, 'reserveDonation'])->name('volunteer.donations.reserve');
    // Collect donation
    Route::post('/donations/{id}/collect', [VolunteersController::class,'collectDonation'])->name('volunteer.donations.collect');
});



Route::middleware(['auth', \App\Http\Middleware\Role::class.':admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminsController::class, 'dashboard'])
        ->name('admin.dashboard');
    // View all donations
    Route::get('/donations', [AdminsController::class, 'listDonations'])
        ->name('admin.donations');

    // Assign Donation to Volunteer
    Route::post('/donations/{id}/assign', [AdminsController::class, 'assignDonation'])
        ->name('admin.donations.assign');
    // Complete Donation
    Route::post('/donations/{id}/complete', [AdminsController::class, 'completeDonation'])
        ->name('admin.donations.complete');

    // Manage Volunteers
    Route::get('/volunteers', [AdminsController::class, 'listVolunteers'])
        ->name('admin.volunteers.index');
    Route::get('/volunteers/add', [AdminsController::class, 'addVolunteer'])
        ->name('admin.volunteers.add');
    Route::post('/volunteers', [AdminsController::class, 'storeVolunteer'])
        ->name('admin.volunteers.store');
    Route::get('/volunteers/{id}/edit', [AdminsController::class, 'editVolunteer'])
        ->name('admin.volunteers.edit');
    Route::put('/volunteers/{id}', [AdminsController::class, 'updateVolunteer'])
        ->name('admin.volunteers.update');
    Route::delete('/volunteers/{id}', [AdminsController::class, 'deleteVolunteer'])
        ->name('admin.volunteers.delete');

    // Manage Donors
    Route::get('/donors', [AdminsController::class, 'listDonors'])
        ->name('admin.donors.index');
    Route::get('/donors/add', [AdminsController::class, 'addDonor'])
        ->name('admin.donors.add');
    Route::post('/donors', [AdminsController::class, 'storeDonor'])
        ->name('admin.donors.store');
    Route::put('/donors/{id}', [AdminsController::class, 'updateDonor'])
        ->name('admin.donors.update');
    Route::delete('/donors/{id}', [AdminsController::class, 'deleteDonor'])
        ->name('admin.donors.delete');
        
    // Manage Families
    Route::get('/families', [AdminsController::class, 'listFamilies'])
        ->name('admin.families.index');
    Route::get('/families/add', [AdminsController::class, 'addFamily'])
        ->name('admin.families.add');
    Route::post('/families', [AdminsController::class, 'storeFamily'])
        ->name('admin.families.store');
    Route::get('/families/{id}/edit', [AdminsController::class, 'editFamily'])
        ->name('admin.families.edit');
    Route::put('/families/{id}', [AdminsController::class, 'updateFamily'])
        ->name('admin.families.update');
    Route::delete('/families/{id}', [AdminsController::class, 'deleteFamily'])
        ->name('admin.families.delete');

    // Reports
    Route::get('/reports', [AdminsController::class, 'reports'])
        ->name('admin.reports');
});



require __DIR__.'/auth.php';







// <?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\HomeController;
// // use App\Http\Controllers\AuthController;
// use App\Http\Controllers\DonorsController;
// use App\Http\Controllers\VolunteersController;
// use App\Http\Controllers\AdminsController;
// use App\Http\Controllers\DonationsController;
// //use App\Http\Controllers\NewDonationController;

// use App\Http\Controllers\Auth\AuthenticatedSessionController;
// use App\Http\Controllers\Auth\RegisteredUserController;
// use Illuminate\Support\Facades\Auth;
// //use App\Http\Middleware\Role;

// Route::get('/', [HomeController::class, 'index'])->name('home');
// // Create donation as guest
// Route::get('/donations/create', [DonationsController::class, 'createDonation'])->name('guest.donations.create');
// // Submit (Store) new donation as guest
// Route::post('/donations', [DonationsController::class, 'storeDonation'])->name('guest.donations.store');

// Route::get('/dashboard', function () {
//     if (Auth::check()) {
//         return redirect()->route(Auth::user()->role . '.dashboard');
//     }
//     return redirect()->route('login');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });




// // Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// // Route::post('/login', [AuthController::class, 'login']);
// // Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// // Route::post('/register', [AuthController::class, 'register']);
// // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
// Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
// Route::post('/register', [RegisteredUserController::class, 'store']);

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


// Route::middleware(['auth', 'role:donor'])->prefix('donor')->group(function () {
//     Route::get('/dashboard', [DonorsController::class, 'dashboard'])->name('donor.dashboard');
//     // View own donations
//     Route::get('/donations', [DonorsController::class, 'donations'])->name('donor.donations');
//     // Add donation (form)
//     Route::get('/donations/add', [DonorsController::class, 'addDonation'])->name('donor.donations.add');
//     // Submit (Store) new donation
//     Route::post('/donations', [DonorsController::class, 'storeDonation'])->name('donor.donations.store');
//     // Update Donation (Submitted from Modal)
//     Route::put('/donations/{id}', [DonorsController::class, 'updateDonation'])->name('donor.donations.update');
//     // Cancel donation
//     Route::delete('/donations/{id}', [DonorsController::class, 'cancelDonation'])->name('donor.donations.cancel');
// });



// Route::middleware(['auth', 'role:volunteer'])->prefix('volunteer')->group(function () {
//     Route::get('/dashboard', [VolunteersController::class, 'dashboard'])->name('volunteer.dashboard');
//     // View assigned/reserved donations
//     Route::get('/donations', [VolunteersController::class, 'donations'])->name('volunteer.donations');
//     // reserve donation
//     Route::post('/donations/{id}/reserve', [VolunteersController::class, 'reserveDonation'])->name('volunteer.donations.reserve');
//     // Collect donation
//     Route::post('/donations/{id}/collect', [VolunteersController::class,'collectDonation'])->name('volunteer.donations.collect');
// });



// Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
//     Route::get('/dashboard', [AdminsController::class, 'dashboard'])->name('admin.dashboard');
//     // View all donations
//     Route::get('/donations', [AdminsController::class, 'listDonations'])->name('admin.donations');

//     // Assign Donation to Volunteer
//     Route::post('/donations/{id}/assign', [AdminsController::class, 'assignDonation'])->name('admin.donations.assign');

//     // Manage Volunteers
//     Route::get('/volunteers', [AdminsController::class, 'listVolunteers'])->name('admin.volunteers.index');
//     Route::get('/volunteers/add', [AdminsController::class, 'addVolunteer'])->name('admin.volunteers.add');
//     Route::post('/volunteers', [AdminsController::class, 'storeVolunteer'])->name('admin.volunteers.store');
//     Route::put('/volunteers/{id}', [AdminsController::class, 'updateVolunteer'])->name('admin.volunteers.update');
//     Route::delete('/volunteers/{id}', [AdminsController::class, 'deleteVolunteer'])->name('admin.volunteers.delete');
//     // Manage Donors
//     Route::get('/donors', [AdminsController::class, 'listDonors'])->name('admin.donors.index');
//     Route::get('/donors/add', [AdminsController::class, 'addDonor'])->name('admin.donors.add');
//     Route::post('/donors', [AdminsController::class, 'storeDonor'])->name('admin.donors.store');
//     Route::put('/donors/{id}', [AdminsController::class, 'updateDonor'])->name('admin.donors.update');
//     Route::delete('/donors/{id}', [AdminsController::class, 'deleteDonor'])->name('admin.donors.delete');
//     // Manage Families
//     Route::get('/families', [AdminsController::class, 'listFamilies'])->name('admin.families.index');
//     Route::get('/families/add', [AdminsController::class, 'addFamily'])->name('admin.families.add');
//     Route::post('/families', [AdminsController::class, 'storeFamily'])->name('admin.families.store');
//     Route::put('/families/{id}', [AdminsController::class, 'updateFamily'])->name('admin.families.update');
//     Route::delete('/families/{id}', [AdminsController::class, 'deleteFamily'])->name('admin.families.delete');
// });



// require __DIR__.'/auth.php';
