<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    //
    public function event()
    {
        return view('admin.attendance-event');
    }

    public function workshop($workshop_id)
    {

        return view('admin.attendance-workshop', compact('workshop_id'));
    }

    public function markEvent($qrcodevalue)
    {
        $registration = Registration::where('qr_code_value', $qrcodevalue)->first();
        
        if (!$registration) {
            return response()->json([
                'success' => false,
                'message' => 'QR Code not found.'
            ], 404);
        }

        // Check if already checked into the main event
        if ($registration->status === 'checked_in') {
            return response()->json([
                'success' => false,
                'message' => 'Already checked in to the event.'
            ]);
        }

        if ($registration->status === 'not_going') {
            return response()->json([
                'success' => false,
                'message' => 'This attendee is marked as NOT GOING.'
            ]);
        }

        // AUTO-UPDATE: Set both main status and workshop status on event entry
        $registration->status = 'checked_in';
        $registration->workshop_status = 'checked_in'; 
        $registration->save();

        Attendance::create([
            'registration_id' => $registration->id,
            'type' => 'event',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Event and Workshop attendance marked successfully!',
            'attendee' => $registration->attendee->name ?? 'Attendee'
        ]);
    }
    public function markWorkshop($workshop_id, $qrcodevalue)
    {
        $registration = Registration::where('qr_code_value', $qrcodevalue)
            ->where('workshop_id', $workshop_id)
            ->first();

        if (!$registration) {
            return response()->json([
                'success' => false,
                'message' => 'Attendee not registered for this specific workshop.'
            ], 404);
        }

        if ($registration->workshop_status === 'checked_in') {
            return response()->json([
                'success' => false,
                'message' => 'Already checked in to this workshop.'
            ]);
        }

        $registration->workshop_status = 'checked_in';
        $registration->save();

        Attendance::create([
            'registration_id' => $registration->id,
            'type' => 'workshop',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Workshop attendance marked successfully.'
        ]);
    }
    // Manual Workshop Status Update from Admin Table
    public function updateWorkshopStatus(Request $request, $id) {
        $registration = Registration::findOrFail($id);
        
        // Update the workshop_status column
        $registration->workshop_status = $request->workshop_status;
        $registration->save();

        return back()->with('success', 'Workshop status updated manually.');
    }
}
