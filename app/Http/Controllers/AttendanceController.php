<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Registration;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //
    public function event()
    {
        return view('admin.attendance');
    }

    public function markEvent($qrcodevalue)
    {
        $registration = Registration::where('qr_code_value', $qrcodevalue)->first();
        // if ($registration) {
        //     $registration->status = 'checked_in';
        //     $registration->save();

        //     Attendance::create([
        //         'registration_id' => $registration->id,
        //         'type' => 'event',
        //     ]);

        //     return response()->json(['message' => 'Attendance marked successfully.']);
        // }
        // return response()->json([
        //     'success' => false,
        //     'message' => 'Registration not found or already checked in.'
        // ], 404);
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

    // Manual Update from Admin Table
    public function updateStatus(Request $request, $id) {
        $registration = Registration::findOrFail($id);
        $registration->status = $request->status;
        $registration->save();

        return back()->with('success', 'Status updated manually.');
    }
}
