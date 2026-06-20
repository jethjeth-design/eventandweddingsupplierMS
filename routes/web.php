<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\EventcategoryController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SupplierProfileController;
use App\Http\Controllers\SupplierPortfolioController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClientBrowseController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierAvailabilityController;
use App\Http\Controllers\AdminAvailabilityController;
use App\Http\Controllers\ClientCalendarController;
use App\Http\Controllers\ClientDashboardController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\Admin\FeaturedPackageController;
use App\Http\Controllers\Admin\EventBundleController;
use App\Http\Controllers\Admin\AdminMessageController;
use App\Http\Controllers\PopularPackageController;
use App\Http\Controllers\Admin\FeaturedSupplierController;
use App\Http\Controllers\PopularTrackingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Supplier\SupplierDashboardController;
use App\Http\Controllers\CollaborationController;
use App\Http\Controllers\CollaborationMemberController;
use App\Http\Controllers\SupplierTeamMemberController;

use App\Http\Controllers\ClientBidController;
use App\Http\Controllers\SupplierBidController;
use Illuminate\Support\Facades\Route;

//Welcome Pages
Route::get('/', [HomeController::class, 'index'])->name('welcomepage.welcome');
    Route::get('/profile', [HomeController::class, 'showprofile'])->name('welcomepage.profile');
    Route::get('/profile/{id}', [HomeController::class, 'showprofiledetails'])->name('welcomepage.profiledetails');
    Route::get('/gallery/{id}', [HomeController::class, 'showgallery'])->name('welcomepage.gallery');
    Route::get('/gallery/', [HomeController::class, 'gallery'])->name('welcomepage.galleries');
    Route::get('/package', [HomeController::class, 'package'])->name('welcomepage.package');
    Route::get('/event', [HomeController::class, 'event'])->name('welcomepage.event');
    Route::get('/popular-packages/{id}', [HomeController::class, 'showPopular'])
    ->name('popular.show');

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

// Show supplier registration form
Route::get('/register/supplier', [RegisteredUserController::class, 'createSupplier'])
    ->middleware('guest')
    ->name('register.supplier');

// Handle supplier registration
Route::post('/register/supplier', [RegisteredUserController::class, 'storeSupplier'])
    ->middleware('guest')
    ->name('supplier.register.store');

// Admin routes
Route::middleware(['auth', 'verified','role:admin'])->group(function () {
    
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Supplier routes
Route::middleware(['auth', 'verified', 'role:supplier'])->group(function () {
    Route::get('/supplier/dashboard', function () {
        return view('supplier.dashboard');
    })->name('supplier.dashboard');
});

// Client routes
Route::middleware(['auth', 'verified', 'role:client'])->group(function () {
    Route::get('/client/dashboard', function () {
        return view('client.dashboard');
    })->name('client.dashboard');
});

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

//Admin Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])
    ->name('admin.dashboard');
});

//Supplier Dasyhboard
Route::middleware(['auth'])->group(function () {
    Route::get('/supplier/dashboard', [SupplierDashboardController::class, 'dashboard'])
    ->name('supplier.dashboard');
});
//Client Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/client/dashboard', [ClientDashboardController::class, 'dashboard'])
    ->name('client.dashboard');
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

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/subcategories', [SubcategoryController::class, 'index'])->name('subcategories.list');
    Route::get('subcategories/create', [SubcategoryController::class, 'create'])->name('subcategories.create');
    Route::post('subcategories', [SubcategoryController::class, 'store'])->name('subcategories.store');
   Route::put('subcategories/{subcategory}', [SubcategoryController::class, 'update'])->name('subcategories.update');
    Route::delete('subcategories/{id}', [SubcategoryController::class, 'destroy'])->name('subcategories.destroy');
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
    //Pricing Updates
    Route::get('/supplier/pricing/{supplierProfile}/editPricing', [SupplierProfileController::class, 'editPricing'])->name('supplier.editPricing');
    Route::put('/supplier/pricing/{supplierProfile}',[SupplierProfileController::class, 'updatePricing'])->name('supplier.pricing.update');
    //Delete
    Route::delete('/supplier/supplierProfiles/{supplierProfile}', [SupplierProfileController::class, 'destroy'])->name('supplier.destroy');
    //Cover Photo
    Route::post('/supplier/cover-photo', [SupplierProfileController::class, 'storeCoverPhoto'])
    ->name('supplier.cover.store');


    Route::delete('/supplier/cover-photo/delete', [SupplierProfileController::class, 'deleteCoverPhoto'])
    ->name('supplier.cover.delete');
});

//Supplier Portfolio routes
Route::middleware(['auth'])->group(function () {
    Route::get('/supplier/portfolio', [SupplierPortfolioController::class, 'index'])->name('supplier.portfolio.index');
    Route::get('/supplier/portfolio/create', [SupplierPortfolioController::class, 'create'])->name('supplier.portfolio.create');
    Route::post('/supplier/portfolio', [SupplierPortfolioController::class, 'store'])->name('supplier.portfolio.store');
    Route::get('/supplier/portfolio/{portfolio}/edit', [SupplierPortfolioController::class, 'edit'])->name('supplier.portfolio.edit');
    Route::put('/supplier/portfolio/{portfolio}', [SupplierPortfolioController::class, 'update'])->name('supplier.portfolio.update');
    Route::delete(
    '/supplier/portfolio/{supplierPortfolio}/image/{index}',
    [SupplierPortfolioController::class, 'deleteImage']
)->name('supplier.portfolio.image.delete');

Route::delete(
    '/supplier/portfolio/{supplierPortfolio}/video',
    [SupplierPortfolioController::class, 'deleteVideo']
)->name('supplier.portfolio.video.delete');
    //Gallery Routes
    Route::get('/supplier/gallery', [GalleryController::class, 'index'])->name('supplier.portfolio.gallery');
});



//Client Browse Suppliers
Route::middleware(['auth'])->group(function () {
   
    Route::get('/browse-suppliers', [ClientBrowseController::class, 'index'])
    ->name('client.browse.suppliers');

    Route::get('/popular-packages.show/{id}', [ClientBrowseController::class, 'showPopular'])
    ->name('popular.packages.show');

    Route::get('/browse-all-suppliers', [ClientBrowseController::class, 'supplier'])
    ->name('client.all.suppliers');

    Route::get('/browse-suppliers/{id}', [ClientBrowseController::class, 'show'])
        ->name('client.show.supplier');

    route::get('/supplier/{id}/portfolio', [ClientBrowseController::class, 'portfolio'])
    ->name('client.portfolio');

    Route::post('/client/bookings', [BookingController::class, 'store'])
    ->name('client.bookings.store');
     
    //Popular Packages
    Route::post(
    '/bookings/store',
    [BookingController::class, 'store']
)->name('bookings.store');

    // Client Calendar
    Route::get('/supplier/{id}/calendar', [ClientCalendarController::class, 'show'])
    ->name('client.supplier.calendar');

    Route::get('/supplier/{id}/calendar/events', [ClientCalendarController::class, 'events'])
    ->name('client.supplier.calendar.events');
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
        ->name('messages.send');

    Route::post('/messages/offer', [MessageController::class, 'sendOffer'])
    ->name('messages.offer');

Route::post('/messages/counter/{messageId}', [MessageController::class, 'counterOffer'])
    ->name('messages.counter');

Route::post('/messages/accept/{messageId}', [MessageController::class, 'acceptOffer'])
    ->name('messages.accept');

Route::post('/messages/reject/{messageId}', [MessageController::class, 'rejectOffer'])
    ->name('messages.reject');

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
    //My Listing
    Route::get('/supplier/my-listings', [PackageController::class, 'listing'])->name('supplier.package.mylistings');
    Route::post('/supplier/package/{id}/toggle', [PackageController::class, 'togglePublish'])
    ->name('supplier.package.toggle');
    // Assign Teams to Package
    Route::post('/package/{id}/assign-teams', [PackageController::class, 'assignTeams'])
    ->name('supplier.package.assignTeams');
    Route::get('/supplier/package/{id}/assign-teams', [PackageController::class, 'showAssignTeams'])
    ->name('supplier.package.assignTeamsForm');
    //Admin
    Route::get('/admin/index', [PackageController::class, 'list'])->name('admin.package.list');
});

//Event for Client
Route::middleware(['auth'])->group(function () {
    //Admin view of events
    Route::get('/admin/events', [EventController::class, 'adminIndex'])
    ->name('admin.events.index');
     // CLIENT
    Route::get('/client/index', [EventController::class, 'index'])->name('client.events');
    Route::get('/client/events/{id}', [EventController::class, 'show'])->name('client.show');
    Route::post('/client/events', [EventController::class, 'store'])->name('client.events.store');
    Route::patch('/client/events/{id}/cancel', [EventController::class, 'cancel'])
    ->name('client.events.cancel');
    Route::patch('/client/events/{id}/complete', [EventController::class, 'complete'])->name('client.events.complete');
    Route::delete('/client/events/{event}', [EventController::class, 'destroy'])->name('client.events.destroy');

    Route::get('/client/calendar', [EventController::class, 'calendar'])
    ->name('client.calendar');

Route::get('/client/events/calendar-data', [EventController::class, 'calendarData'])
    ->name('client.calendar.data');
});
//Client Booking routes
Route::middleware(['auth'])->group(function () {

    // ==========================
    // CLIENT BOOKING
    // ==========================
    Route::get('/my-bookings', [BookingController::class, 'clientIndex'])
    ->name('client.bookings.index');
    // Timeline view for clients
    Route::get('/my-orders', [BookingController::class, 'timeline'])
    ->name('client.timeline');
    // ADMIN TIMELINE
    Route::get('/admin/timeline', [BookingController::class, 'adminTimeline'])
    ->name('admin.timeline');
    Route::post('/bookings/store', [BookingController::class, 'store'])
        ->name('bookings.store');
    
    // ==========================
    // SUPPLIER DASHBOARD
    // ==========================
    Route::get('/supplier/bookings', [BookingController::class, 'supplierIndex'])
        ->name('supplier.bookings');

    // ==========================
    // Admin DASHBOARD
    // ==========================
    Route::get('/admin/bookings', [BookingController::class, 'adminIndex'])
        ->name('admin.bookings');

    // ==========================
    // SUPPLIER ACTIONS
    // ==========================
    Route::post('/supplier/bookings/{id}/approve', [BookingController::class, 'approve'])
        ->name('supplier.bookings.approve');

    Route::post('/supplier/bookings/{id}/cancel', [BookingController::class, 'cancel'])
        ->name('supplier.bookings.cancel');

});
//Client Ratings
Route::middleware(['auth'])->group(function () {

    // ⭐ Store rating (client submits review)
    Route::post('/ratings', [RatingController::class, 'store'])
        ->name('client.ratings.store');
    Route::get('/supplier/ratings', [RatingController::class, 'reviews'])
        ->name('supplier.ratings.index');

});

//Role Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
});

// Supplier Availability Routes
Route::middleware(['auth'])->group(function () {
     // calendar page
    Route::get('/availability', [SupplierAvailabilityController::class, 'index'])
        ->name('supplier.availability.index');

    // load events (FullCalendar)
    Route::get('/availability/events', [SupplierAvailabilityController::class, 'events'])
        ->name('supplier.availability.events');

    // save availability
    Route::post('/availability/store', [SupplierAvailabilityController::class, 'store'])
        ->name('supplier.availability.store');

    Route::post('/supplier/availability/update', [SupplierAvailabilityController::class, 'update'])
    ->name('supplier.availability.update');

    Route::delete('/supplier/availability/{id}', [SupplierAvailabilityController::class, 'destroy'])
    ->name('supplier.availability.delete');
});

// Admin Calendar Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/calendar', [AdminAvailabilityController::class, 'index'])
    ->name('admin.calendar.index');

    Route::get('/admin/calendar/events', [AdminAvailabilityController::class, 'events'])
        ->name('admin.calendar.events');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/notifications/read/{id}', function ($id) {
        auth()->user()->notifications()->findOrFail($id)->markAsRead();
        return back();
    })->name('notifications.read');

    Route::post('/notifications/read-all', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.readAll');
});
Route::post('/notifications/{id}/read', function ($id) {
    auth()->user()
        ->notifications()
        ->where('id', $id)
        ->update(['read_at' => now()]);
});

Route::post('/notifications/read-all', function () {
    auth()->user()->unreadNotifications->markAsRead();
});

Route::get('/notifications', function () {
    return view('notifications.index');
})->name('notifications.index')->middleware('auth');


//Popular Packages For Admin
Route::middleware(['auth'])->group(function () {

    Route::get('/popular-packages', [PopularPackageController::class, 'index'])
        ->name('admin.popular.index');

    Route::get('/popular-packages/create', [PopularPackageController::class, 'create'])
        ->name('admin.popular.create');

    Route::post('/popular-packages', [PopularPackageController::class, 'store'])
        ->name('admin.popular.store');

    Route::delete('/popular-package/{id}', [PopularPackageController::class, 'destroy'])
    ->name('admin.popular.delete');

    Route::get('/popular-packages.supplier/{id}',
    [PopularPackageController::class, 'matching'])->name('popular.package.show');

    });

Route::middleware(['auth'])->group(function () {
 
    // Featured Suppliers
    Route::get('/featured-suppliers', [FeaturedSupplierController::class, 'index'])
         ->name('featured-suppliers');
 
    Route::patch('/featured-suppliers/{supplierProfile}/toggle', [FeaturedSupplierController::class, 'toggle'])
         ->name('featured-suppliers.toggle');
 
});
// ADMIN Popular Tracking
Route::middleware(['auth'])->group(function () {
 
     Route::get('/popular-tracking', [
        PopularTrackingController::class,
        'index'
    ])->name('admin.popular.tracking');

    Route::get('/popular-tracking/{id}', [
        PopularTrackingController::class,
        'show'
    ])->name('admin.popular.tracking.show');
 
});
//Supplier Collaborations 
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Collaboration Projects
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/collaborations',
        [CollaborationController::class, 'index']
    )->name('collaborations.index');

    Route::post(
        '/collaborations',
        [CollaborationController::class, 'store']
    )->name('collaborations.store');
  
    Route::patch(
        '/collaborations/{collaboration}/complete',
        [CollaborationController::class, 'complete']
    )->name('collaborations.complete');
    
    Route::put(
        '/collaborations/{collaboration}',
        [CollaborationController::class, 'update']
    )->name('collaborations.update');

    Route::delete(
        '/collaborations/{collaboration}',
        [CollaborationController::class, 'destroy']
    )->name('collaborations.destroy');

    Route::get(
        '/collaborations/{collaboration}',
        [CollaborationController::class, 'show']
    )->name('collaborations.show');
    


    /*
    |--------------------------------------------------------------------------
    | Collaboration Members
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/collaboration-members',
        [CollaborationMemberController::class, 'store']
    )->name('collaboration.members.store');

    Route::patch(
        '/collaboration-members/{member}/accept',
        [CollaborationMemberController::class, 'accept']
    )->name('collaboration.members.accept');

    Route::patch(
        '/collaboration-members/{member}/reject',
        [CollaborationMemberController::class, 'reject']
    )->name('collaboration.members.reject');
    Route::delete(
    '/collaboration-members/{member}',
    [CollaborationMemberController::class, 'destroy']
    )->name('collaboration.members.destroy');

    /*
    |--------------------------------------------------------------------------
    | Incoming Invitations
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/my-collaborations',
        [CollaborationMemberController::class, 'myCollaborations']
    )->name('my.collaborations');

});

//Supplier Team Members
Route::middleware(['auth'])->group(function () {
    Route::get(
        '/supplier/team-members',
        [SupplierTeamMemberController::class, 'index']
    )->name('supplier.team-members.index');

    Route::post(
        '/supplier/team-members/store',
        [SupplierTeamMemberController::class, 'store']
    )->name('supplier.team-members.store');

    Route::post(
        '/supplier/team-members/{member}',
        [SupplierTeamMemberController::class, 'update']
    )->name('supplier.team-members.update');

    Route::delete(
        '/supplier/team-members/{member}',
        [SupplierTeamMemberController::class, 'destroy']
    )->name('supplier.team-members.destroy');

});
//Messaging Routes
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Inbox
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/messages',
        [MessageController::class, 'inbox']
    )->name('messages.inbox');

    Route::get('/messages/start/{user}', [MessageController::class, 'startChat'])->name('messages.start');

    /*
    |--------------------------------------------------------------------------
    | Open Chat
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/messages/open/{user}',
        [MessageController::class, 'open']
    )->name('messages.open');

    /*
    |--------------------------------------------------------------------------
    | Chat Room
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/messages/chat/{conversation}',
        [MessageController::class, 'chat']
    )->name('messages.chat');

    /*
    |--------------------------------------------------------------------------
    | Send Message
    |--------------------------------------------------------------------------
    */

    Route::post('/messages/send', [MessageController::class, 'send'])
    ->name('messages.send');

    /*
    |--------------------------------------------------------------------------
    | Send Message
    |--------------------------------------------------------------------------
    */
    Route::post(
        '/group-chat/store',
        [MessageController::class, 'storeGroupChat']
    )->name('group.chat.store');
    
    
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/inbox', [AdminMessageController::class, 'inbox'])
        ->name('admin.inbox');

    Route::get('/admin/chat/{conversation}', [AdminMessageController::class, 'chat'])
        ->name('admin.chat');

    Route::post('/admin/messages/send', [AdminMessageController::class, 'send'])
        ->name('admin.messages.send');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/client/bids',
        [ClientBidController::class,'index'])
        ->name('client.bids.index');

    Route::get('/client/bids/{bid}',
        [ClientBidController::class,'show'])
        ->name('client.bids.show');

    Route::post('/client/bids/package/{package}',
        [ClientBidController::class,'store'])
        ->name('client.bids.store');

    Route::post('/client/bids/{bid}/reply',
        [ClientBidController::class,'reply'])
        ->name('client.bids.reply');
    Route::post(
        '/client/bids/{bid}/accept',
        [ClientBidController::class, 'accept']
    )->name('client.bids.accept');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/supplier/bids',
        [SupplierBidController::class,'index'])
        ->name('supplier.bids.index');

    Route::get('/supplier/bids/{bid}',
        [SupplierBidController::class,'show'])
        ->name('supplier.bids.show');

    Route::post('/supplier/bids/{bid}/counter',
        [SupplierBidController::class,'counter'])
        ->name('supplier.bids.counter');

    Route::post('/supplier/bids/{bid}/accept',
        [SupplierBidController::class,'accept'])
        ->name('supplier.bids.accept');

    Route::post('/supplier/bids/{bid}/reject',
        [SupplierBidController::class,'reject'])
        ->name('supplier.bids.reject');
});

require __DIR__.'/auth.php';