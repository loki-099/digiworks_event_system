<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AttendaceExport;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Registration;
use App\Models\Workshop;
use Illuminate\Support\Facades\Auth;
use App\Exports\RegistrationsExport;
use App\Exports\AttendanceExport;
use App\Models\Attendance;
use App\Models\Pitching;
use Maatwebsite\Excel\Facades\Excel;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        $users = User::where('role','!=', 'admin') ->get();
        $event = Event::all()->first();
        $attendees = Registration::all()->count();
        $checked_in = Registration::all()->where('status', 'checked_in')->count();
        $workshops = Workshop::all();
        return view('admin.dashboard', compact('event', 'workshops', 'admin', 'attendees', 'checked_in'));
    }

    public function addEvent(Request $request) {
        $request->validate([ 
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'venue' => 'required|string|max:255',
        ]);

        Event::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'venue' => $request->input('venue'),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Event added successfully.');
    }

    public function updateEvent(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'venue' => 'required|string|max:255',
        ]);

        $event = Event::find($id);
        if ($event) {
            $event->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'venue' => $request->input('venue'),
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Event updated successfully.');
    }

    public function addWorkshop(Request $request, $eventId) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'speaker' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        Workshop::create([
            'event_id' => $eventId,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'capacity' => $request->input('capacity'),
            'speaker' => $request->input('speaker'),
            'venue' => $request->input('venue'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Workshop added successfully.');
    }

    public function updateWorkshop(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'speaker' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $workshop = Workshop::find($id);
        if ($workshop) {
            $workshop->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'capacity' => $request->input('capacity'),
                'speaker' => $request->input('speaker'),
                'venue' => $request->input('venue'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Workshop updated successfully.');
    }

    public function deleteWorkshop($id) {
        $workshop = Workshop::find($id);
        if ($workshop) {
            $workshop->delete();
        }

        return redirect()->route('admin.dashboard')->with('success', 'Workshop deleted successfully.');
    }
    // handles the separte users page in admin dashboard

    public function users(Request $request)
    {
        $admin = Auth::user();
        $query = Registration::with(['attendee', 'workshop', 'pitching']);
        // $pitching = Pitching::with(['registration']);

        // Check if there is a search term
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('attendee', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('affiliation', 'like', "%{$search}%");
            });
        }

        // SORTING
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');

        $allowedSorts = [
            'id',
            'registered_date',
            'name',
            'email',
            'affiliation',
            'group_name',
            'organization'
        ];

        if (in_array($sort, $allowedSorts)) {

            // Sort registration columns
            if (in_array($sort, ['id', 'registered_date'])) {
                $query->orderBy($sort, $direction);
            }

            // Sort attendee columns
            elseif (in_array($sort, ['name', 'email', 'affiliation'])) {

                $query->join('users', 'users.id', '=', 'registration.attendee_id')
                    ->orderBy("users.$sort", $direction)
                    ->select('registration.*');
            }

            // Sort pitching columns
            elseif (in_array($sort, ['group_name', 'organization'])) {

                $query->leftJoin('pitching', 'pitching.registration_id', '=', 'registration.id')
                    ->orderBy("pitching.$sort", $direction)
                    ->select('registration.*');
            }
        }
        // set paginate to 50
        $registrations = $query->paginate(50);
        

        return view('admin.adminUsers', compact('registrations', 'admin'));
    }

    public function export() 
    {
        return Excel::download(new RegistrationsExport, 'registrations_2026.xlsx');
    }

    public function attendanceExport() {
        return Excel::download(new AttendanceExport, 'attendances_2026.xlsx');
    }

    public function log() {
        $query = Attendance::with('registration.pitching');
        $attendances = $query->paginate(50);
        $admin = Auth::user();

        return view('admin.attendance-log', compact('attendances', 'admin'));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return redirect()->route('admin.users')->with('error', 'User not found.');
        }

        // Prevent deleting admin users
        if ($user->role === 'admin') {
            return redirect()->route('admin.users')->with('error', 'Cannot delete admin users.');
        }

        // Delete the user - cascade will handle related records
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User and all related records deleted successfully.');
    }
}
