<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserSubscriptionController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\SubscriptionController;

// Public routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/how-it-works', [PageController::class, 'howItWorks'])->name('how-it-works');
Route::get('/pricing', [PageController::class, 'pricing'])->name('pricing');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');

// Authentication routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [GoogleAuthController::class, 'login'])->name('login.submit');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [GoogleAuthController::class, 'register'])->name('register.submit');

// Google OAuth routes
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::post('/logout', [GoogleAuthController::class, 'logout'])->name('logout');

// User Dashboard routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // User Documents
    Route::resource('documents', DocumentController::class);
    Route::get('documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    
    // User Reports (read-only)
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/{report}', [ReportController::class, 'show'])->name('reports.show');
    Route::get('reports/{report}/download', [ReportController::class, 'download'])->name('reports.download');
    
    // User Subscriptions
    Route::get('subscriptions', [UserSubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::post('subscriptions/subscribe/{plan}', [UserSubscriptionController::class, 'subscribe'])->name('subscriptions.subscribe');
    Route::get('subscriptions/my-subscription', [UserSubscriptionController::class, 'show'])->name('subscriptions.show');
    Route::post('subscriptions/cancel', [UserSubscriptionController::class, 'cancel'])->name('subscriptions.cancel');
    
    // User Profile
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Admin Dashboard routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Admin Documents
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('documents', DocumentController::class);
        Route::get('documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
        
        // Admin Reports
        Route::resource('reports', ReportController::class);
        Route::get('reports/{report}/download', [ReportController::class, 'download'])->name('reports.download');
        
        // Admin Transactions
        Route::resource('transactions', TransactionController::class);
        
        // Admin Users Management
        Route::resource('users', UserController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
        
        // Admin Plans
        Route::resource('plans', PlanController::class);
        
        // Admin Subscriptions
        Route::resource('subscriptions', SubscriptionController::class);
    });
    
    // Admin Profile
    Route::get('admin/profile', [ProfileController::class, 'show'])->name('admin.profile.show');
    Route::get('admin/profile/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
});


