<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventcategoryController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SupplierProfileController;
use App\Http\Controllers\SupplierPortfolioController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BrowseSupplierController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

//Welcome Pages
Route::get('/', [HomeController::class, 'index'])->name('welcomepage.welcome');
    Route::get('/profile', [HomeController::class, 'showprofile'])->name('welcomepage.profile');
    Route::get('/profile/{id}', [HomeController::class, 'showprofiledetails'])->name('welcomepage.profiledetails');
    Route::get('/gallery', [HomeController::class, 'showgallery'])->name('welcomepage.gallery');
    Route::get('/package', [HomeController::class, 'package'])->name('welcomepage.package');

//Activity Logs
Route::get('/admin/logs', [ActivityLogController::class, 'index'])
    ->name('admin.logs.index');

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
    Route::get('/categories/{category:slug}', [CategoryController::class, 'show']);
    Route::get('/admin/categories/{category:slug}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{category:slug}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category:slug}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
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

//admin supplier management
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/suppliers', [SupplierProfileController::class, 'list'])->name('admin.suppliers.index');
    Route::delete('/admin/suppliers/{supplier}', [SupplierProfileController::class, 'destroyAdmin'])->name('admin.suppliers.destroy');
});


//Supplier routes
Route::middleware(['auth'])->group(function () {
    Route::get('/supplier-profile', [SupplierProfileController::class, 'index'])->name('supplier.supplierprofile');
    Route::get('/supplier/create', [SupplierProfileController::class, 'create'])->name('supplier.create');
    Route::post('/supplier/supplierProfiles', [SupplierProfileController::class, 'store'])->name('supplier.store');
    Route::get('/supplier/supplierProfiles/{supplierProfile}/edit', [SupplierProfileController::class, 'edit'])->name('supplier.edit');
    //Seperated edit
    Route::get('/supplier/supplierProfiles/{supplierProfile}/editidentity', [SupplierProfileController::class, 'editidentity'])->name('supplier.editidentity');
    Route::put('/supplier/supplierProfiles/{supplierProfile}/updateidentity', [SupplierProfileController::class, 'updateidentity'])
    ->name('supplier.updateidentity');
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
    //Gallery Routes
    Route::get('/supplier/gallery', [GalleryController::class, 'index'])->name('supplier.portfolio.gallery');
});



//Browse suppliers for clients
Route::middleware(['auth'])->group(function () {
    Route::get('/client/suppliers', [BrowseSupplierController::class, 'browse'])->name('client.suppliers');
    Route::get('/client/suppliers/{id}', [BrowseSupplierController::class, 'show'])->name('client.suppliers.show');
});

//Messaging for suppliers AND clients (only inbox for suppliers, clients can only message from supplier details page)
Route::middleware(['auth'])->group(function () {
    
    // ✅ Client Inbox
    Route::get('/client/inbox', [MessageController::class, 'inbox'])
        ->name('client.inbox');

    // Open chat (both client & supplier)
    Route::get('/chat/{userId}/{supplierId}', [MessageController::class, 'chat'])
        ->name('chat');

    // Send message (both client & supplier)
    Route::post('/chat/send', [MessageController::class, 'send'])
        ->name('chat.send');

});

// Banner Routes
Route::middleware(['auth'])->group(function () {
    route::get('/home', [BannerController::class, 'index'])->name('admin.homepage.banners');
    Route::post('/banners/store', [BannerController::class, 'store'])->name('banners.store');
     Route::get('/banners/{banner}/edit', [BannerController::class, 'edit'])->name('banners.edit');
    Route::put('/banners/{banner}', [BannerController::class, 'update'])->name('banners.update');
    Route::delete('/banners/{id}', [BannerController::class, 'destroy'])->name('banners.destroy');
});

//Inquiries Routes
   Route::get('/supplier/inbox', [InquiryController::class, 'inbox'])->middleware('auth')->name('supplier.inquiries.inbox');
   Route::get('/supplier/chatbox', [InquiryController::class, 'chatbox'])->name('supplier.chatbox');
   Route::post('/supplier/inquiry/{id}/read', [InquiryController::class, 'markAsRead'])->name('supplier.inquiry.read');
   Route::post('/inquiry/send', [InquiryController::class, 'store'])->name('inquiry.store'); 
   Route::delete('/inquiry/{id}', [InquiryController::class, 'destroy'])->name('inquiry.destroy');



Route::middleware(['auth'])->group(function () {
    // ADMIN
Route::get('/admin/events', [AdminController::class, 'events'])->name('admin.events.index');
Route::post('/admin/events/{id}/approve', [AdminController::class, 'approveEvent'])->name('client.index');
Route::post('/admin/events/{id}/reject', [AdminController::class, 'rejectEvent'])->name('client.index');
});

// Packages Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/supplier/index', [PackageController::class, 'index'])->name('supplier.package.index');
    Route::get('/supplier/packages/{id}', [PackageController::class, 'show'])->name('supplier.package.show');
    Route::post('/supplier/packages', [PackageController::class, 'store'])->name('supplier.package.store');
    Route::get('/supplier/packages/{package}/edit', [PackageController::class, 'edit'])->name('supplier.package.edit');
    Route::put('/supplier/packages/{package}', [PackageController::class, 'update'])->name('supplier.package.update');
    Route::delete('/supplier/packages/{package}', [PackageController::class, 'destroy'])->name('supplier.package.destroy');
    //Admin
    Route::get('/admin/index', [PackageController::class, 'list'])->name('admin.package.list');
});

//Event for Client
Route::middleware(['auth'])->group(function () {

     // CLIENT
    Route::get('/client/index', [EventController::class, 'index'])->name('client.index');
    Route::get('/client/events', [EventController::class, 'create'])->name('client.events');
    Route::get('/client/events/{id}', [EventController::class, 'show'])->name('client.show');
    Route::post('/client/events', [EventController::class, 'store'])->name('client.events.store');
    Route::get('/client/events/{event}/edit', [EventController::class, 'edit'])->name('client.events.edit');
    Route::put('/client/events/{event}', [EventController::class, 'update'])->name('client.events.update');
    Route::delete('/client/events/{event}', [EventController::class, 'destroy'])->name('client.events.destroy');
    //Client Bookings
    Route::post('/book-package', [BookingController::class, 'store'])
    ->name('book.package')
    ->middleware('auth');
});

require __DIR__.'/auth.php';
