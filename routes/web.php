<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDashboardAttendeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Attendee\AttendeeDashboardController;
use App\Http\Controllers\Attendee\EvaluationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\QrCodeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/download-qrcode', [QrCodeController::class, 'downloadQRCode'])->name('download.qrcode');

// evaluation routes

Route::get('/evaluate', [EvaluationController::class, 'showForm'])
    ->name('evaluate.form');

Route::post('/evaluate/submit', [EvaluationController::class, 'submit'])
    ->name('evaluate.submit');

Route::get('/evaluate/success', function () {
    return view('attendee.evaluation_success');
})->name('evaluate.success');

Route::get('/admin/evaluations',
    [EvaluationController::class, 'eventEvaluations'])
->name('admin.event.evaluations');

Route::middleware(['auth'])->group(function () {
    Route::get('/success', [AttendeeDashboardController::class, 'index'])
        ->name('attendee.success');
    Route::post('/dashboard/workshops/{workshop}/join', [AttendeeDashboardController::class, 'joinWorkshop'])
        ->name('attendee.workshops.join');
    Route::post('/dashboard/workshops/{workshop}/cancel', [AttendeeDashboardController::class, 'cancelWorkshop'])
        ->name('attendee.workshops.cancel');
});

Route::prefix('admin')->group(function () {
    // 1. Redirect root to login
    Route::get('/', function () {
        return redirect('/admin/login');
    });

    // 2. Auth Routes
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // 3. Protected Admin Routes
    Route::middleware('admin')->group(function () {
        // Main Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        // User Management - MOVED TO AdminDashboardController@users
        Route::get('/users', [AdminDashboardController::class, 'users'])->name('admin.users');
        Route::get('/users/download', [AdminDashboardController::class, 'export'])->name('admin.users.export');

        // Attendance & Manual Updates
        Route::get('attendance/event', [AttendanceController::class, 'event'])->name('attendance.event');
        Route::put('attendance/event/{qrcodevalue}', [AttendanceController::class, 'markEvent']);
        Route::put('registration/{id}/update', [AttendanceController::class, 'updateStatus'])->name('admin.registration.update');

        // Event/Workshop Management
        Route::post('/addEvent', [AdminDashboardController::class, 'addEvent'])->name('addEvent');
        Route::post('/addWorkshop/{eventId}', [AdminDashboardController::class, 'addWorkshop'])->name('addWorkshop');
        Route::put('/updateEvent/{id}', [AdminDashboardController::class, 'updateEvent'])->name('updateEvent');
        Route::put('/updateWorkshop/{id}', [AdminDashboardController::class, 'updateWorkshop'])->name('updateWorkshop');
        Route::delete('/deleteWorkshop/{id}', [AdminDashboardController::class, 'deleteWorkshop'])->name('deleteWorkshop');
    });
    Route::get('export-registrations', [AdminDashboardController::class, 'export'])->name('admin.export');

    // 4. Shared Auth Routes (Profile)
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__ . '/auth.php';
