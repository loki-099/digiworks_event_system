<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Change to Registration soon
use Illuminate\Support\Facades\Auth;
use App\Models\Registration; // Add this line to import the Registration model

class AdminDashboardAttendeeController extends Controller
{
    //
    public function index() {
        $admin = Auth::user();
        $registrations = Registration::with('attendee')->get();
        return view('admin.adminUsers', compact('registrations', 'admin'));
    }
}
