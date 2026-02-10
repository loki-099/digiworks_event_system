<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDashboardAttendeeController;
use App\Http\Controllers\Attendee\AttendeeDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AttendeeDashboardController::class, 'index'])
        ->name('attendee.dashboard');
    Route::post('/dashboard/workshops/{workshop}/join', [AttendeeDashboardController::class, 'joinWorkshop'])
        ->name('attendee.workshops.join');
    Route::post('/dashboard/workshops/{workshop}/cancel', [AttendeeDashboardController::class, 'cancelWorkshop'])
        ->name('attendee.workshops.cancel');
});


Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect('/admin/login');
    });

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('admin.login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard')
        ->middleware('admin');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // The new users management page
    Route::get('/users', [AdminDashboardAttendeeController::class, 'index'])->name('admin.users');
    Route::post('/addEvent', [AdminDashboardController::class, 'addEvent'])->name('addEvent');
    Route::post('/addWorkshop/{eventId}', [AdminDashboardController::class, 'addWorkshop'])->name('addWorkshop');
    Route::put('/updateEvent/{id}', [AdminDashboardController::class, 'updateEvent'])->name('updateEvent');
    Route::put('/updateWorkshop/{id}', [AdminDashboardController::class, 'updateWorkshop'])->name('updateWorkshop');
    Route::delete('/deleteWorkshop/{id}', [AdminDashboardController::class, 'deleteWorkshop'])->name('deleteWorkshop');
});

require __DIR__ . '/auth.php';
