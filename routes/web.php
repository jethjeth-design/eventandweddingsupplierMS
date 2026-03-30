<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventcategoryController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SupplierProfileController;
use App\Http\Controllers\SupplierPortfolioController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AIRecommendationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    return match($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'supplier' => redirect()->route('supplier.dashboard'),
        'client' => redirect()->route('client.dashboard'),
        default => redirect('/'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //User View
    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user');
    Route::delete('/admin/user/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    //Profile Edit
    Route::get('/admin/profile', [ProfileController::class, 'editAdmin'])->name('admin.profile');
    Route::get('/supplier/profile', [ProfileController::class, 'editSupplier'])->name('supplier.profile');
    Route::get('/client/profile', [ProfileController::class, 'editClient'])->name('client.profile');

    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Show supplier registration form
Route::get('/register/supplier', [RegisteredUserController::class, 'createSupplier'])
    ->middleware('guest')
    ->name('register.supplier');

// Handle supplier registration
Route::post('/register/supplier', [RegisteredUserController::class, 'storeSupplier'])
    ->middleware('guest')
    ->name('supplier.register.store');

// Supplier landing page
Route::middleware(['auth','supplier'])->group(function() {
    Route::get('/supplier/dashboard', function() {
        return view('supplier.dashboard');
    })->name('supplier.dashboard');
});


// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Supplier routes
Route::middleware(['auth', 'role:supplier'])->group(function () {
    Route::get('/supplier/dashboard', function () {
        return view('supplier.dashboard');
    })->name('supplier.dashboard');
});

// Client routes
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/dashboard', function () {
        return view('client.dashboard');
    })->name('client.dashboard');
});

// Theme management routes for admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/themes', [ThemeController::class, 'index'])->name('admin.themes.list');
    //Route::get('/admin/themes/create', [ThemeController::class, 'create'])->name('admin.themes.create');
    Route::post('/admin/themes', [ThemeController::class, 'store'])->name('admin.themes.store');
    //Route::get('/admin/themes/{theme}', [ThemeController::class, 'show'])->name('admin.themes.show');
    Route::get('/admin/themes/{theme}/edit', [ThemeController::class, 'edit'])->name('admin.themes.edit');
    Route::put('/admin/themes/{theme}', [ThemeController::class, 'update'])->name('admin.themes.update');
    Route::delete('/admin/themes/{theme}', [ThemeController::class, 'destroy'])->name('admin.themes.destroy');
});

//Supplier categories 
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.list');
    //Route::get('/admin/themes/create', [CategoryController::class, 'create'])->name('admin.themes.create');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    //Route::get('/admin/themes/{theme}', [CategoryController::class, 'show'])->name('admin.themes.show');
    Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
});

//Event Categories
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/eventcategories', [EventcategoryController::class, 'index'])->name('admin.event.list');
    //Route::get('/admin/themes/create', [EventcategoryController::class, 'create'])->name('admin.themes.create');
    Route::post('/admin/eventcategories', [EventcategoryController::class, 'store'])->name('admin.event.store');
    //Route::get('/admin/themes/{theme}', [EventcategoryController::class, 'show'])->name('admin.themes.show');
    Route::get('/admin/eventcategories/{eventcategory}/edit', [EventcategoryController::class, 'edit'])->name('admin.event.edit');
    Route::put('/admin/eventcategories/{eventcategory}', [EventcategoryController::class, 'update'])->name('admin.event.update');
    Route::delete('/admin/eventcategories/{eventcategory}', [EventcategoryController::class, 'destroy'])->name('admin.event.destroy');
});

//Venues
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/venues', [VenueController::class, 'index'])->name('admin.venue.list');
    //Route::get('/admin/themes/create', [VenueController::class, 'create'])->name('admin.themes.create');
    Route::post('/admin/venues', [VenueController::class, 'store'])->name('admin.venue.store');
    //Route::get('/admin/themes/{theme}', [VenueController::class, 'show'])->name('admin.themes.show');
    Route::get('/admin/venues/{venue}/edit', [VenueController::class, 'edit'])->name('admin.venue.edit');
    Route::put('/admin/venues/{venue}', [VenueController::class, 'update'])->name('admin.venue.update');
    Route::delete('/admin/venues/{venue}', [VenueController::class, 'destroy'])->name('admin.venue.destroy');
});

//Locations
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/locations', [LocationController::class, 'index'])->name('admin.location.list');
    //Route::get('/admin/themes/create', [LocationController::class, 'create'])->name('admin.themes.create');
    Route::post('/admin/locations', [LocationController::class, 'store'])->name('admin.location.store');
    //Route::get('/admin/themes/{theme}', [LocationController::class, 'show'])->name('admin.themes.show');
    Route::get('/admin/locations/{location}/edit', [LocationController::class, 'edit'])->name('admin.location.edit');
    Route::put('/admin/locations/{location}', [LocationController::class, 'update'])->name('admin.location.update');
    Route::delete('/admin/locations/{location}', [LocationController::class, 'destroy'])->name('admin.location.destroy');
    });



//Supplier routes
Route::middleware(['auth'])->group(function () {
    Route::get('/supplier-profile', [SupplierProfileController::class, 'index'])->name('supplier.supplierprofile');
    Route::get('/supplier/supplierProfiles/create', [SupplierProfileController::class, 'create'])->name('supplier.create');
    Route::post('/supplier/supplierProfiles', [SupplierProfileController::class, 'store'])->name('supplier.store');
    //Route::get('/supplier/themes/{theme}', [LocationController::class, 'show'])->name('supplier.themes.show');
    Route::get('/supplier/supplierProfiles/{supplierProfile}/edit', [SupplierProfileController::class, 'edit'])->name('supplier.edit');
    Route::put('/supplier/supplierProfiles/{supplierProfile}', [SupplierProfileController::class, 'update'])->name('supplier.update');
    Route::delete('/supplier/supplierProfiles/{supplierProfile}', [SupplierProfileController::class, 'destroy'])->name('supplier.destroy');
});

//Supplier Portfolio routes
Route::middleware(['auth'])->group(function () {
    Route::get('/supplier/portfolio', [SupplierPortfolioController::class, 'index'])->name('supplier.portfolio.index');
    Route::get('/supplier/portfolio/create', [SupplierPortfolioController::class, 'create'])->name('supplier.portfolio.create');
    Route::post('/supplier/portfolio', [SupplierPortfolioController::class, 'store'])->name('supplier.portfolio.store');
    Route::get('/supplier/portfolio/{portfolio}/edit', [SupplierPortfolioController::class, 'edit'])->name('supplier.portfolio.edit');
    Route::put('/supplier/portfolio/{portfolio}', [SupplierPortfolioController::class, 'update'])->name('supplier.portfolio.update');
    Route::delete('/supplier/portfolio/{portfolio}', [SupplierPortfolioController::class, 'destroy'])->name('supplier.portfolio.destroy');
});

//Event for Client
Route::middleware(['auth'])->group(function () {

    // Create Event
    Route::get('/event/create', [EventController::class, 'index'])
        ->name('events.index');

    Route::post('/event/store', [EventController::class, 'store'])
        ->name('events.store');

    // AI Recommendation
    Route::get('/ai/recommend', [AIRecommendationController::class, 'recommend'])
        ->name('ai.recommend');
});

require __DIR__.'/auth.php';
