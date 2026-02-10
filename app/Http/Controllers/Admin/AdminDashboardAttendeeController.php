<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Change to Registration soon
use Illuminate\Support\Facades\Auth;

class AdminDashboardAttendeeController extends Controller
{
    //
    public function index() {
        $admin = Auth::user();
        $registrations = User::where('role', 'user')->get(); // Use Registration::all() when you switch to Registration model
        return view('admin.adminUsers', compact('registrations', 'admin'));
    }
}
