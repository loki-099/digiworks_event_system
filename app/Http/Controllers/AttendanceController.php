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

        if ($registration->status === 'checked_in') {
            return response()->json([
                'success' => false,
                'message' => 'Already checked in.'
            ]);
        }

        if ($registration->status === 'not_going') {
            return response()->json([
                'success' => false,
                'message' => 'This attendee is not going to the main event.'
            ]);
        }

        $registration->status = 'checked_in';
        $registration->save();

        Attendance::create([
            'registration_id' => $registration->id,
            'type' => 'event',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Attendance marked successfully.'
        ]);
    }

    public function markWorkshop($workshop_id, $qrcodevalue)
    {
        $registration = Registration::where('qr_code_value', $qrcodevalue)->where('workshop_id', $workshop_id)->first();
        Log::info($registration);
        if (!$registration) {
            return response()->json([
                'success' => false,
                'message' => 'QR Code not found.'
            ], 404);
        }

        if ($registration->workshop_status === 'checked_in') {
            return response()->json([
                'success' => false,
                'message' => 'Already checked in.'
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
            'message' => 'Attendance marked successfully.'
        ]);
    }

    // Manual Update from Admin Table
    public function updateStatus(Request $request, $id) {
        $registration = Registration::findOrFail($id);
        $registration->status = $request->status;
        $registration->save();

        return back()->with('success', 'Status updated manually.');
    }
}
