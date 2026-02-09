<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Registration;
class AdminDashboardController extends Controller
{
    public function index()
    {   // logic so the admin gets filtered out when going to users tab in admin page
        $users = User::where('role','!=', 'admin') ->get();
        $attendeesCount = User::where('role', 'user')->count();
        return view('admin.dashboard', compact('attendeesCount'));
    }
    // handles the separte users page in admin dashboard
    public function users(Request $request)
    {
        $query = Registration::with(['attendee', 'workshop']);

        // Check if there is a search term
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('attendee', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('affiliation', 'like', "%{$search}%");
            });
        }

        $registrations = $query->get();

        return view('admin.adminUsers', compact('registrations'));
    }
}
