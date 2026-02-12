<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //
    public function event() {
        return view('admin.attendance');
    }

    public function markEvent($qrcodevalue) {
        $registration = Registration::where('qr_code_value', $qrcodevalue)->where('status', 'registered')->first();
        if ($registration) {
            $registration->status = 'checked_in';
            $registration->save();

            return response()->json(['message' => 'Attendance marked successfully.']);
        }
    }

    // Manual Update from Admin Table
    public function updateStatus(Request $request, $id) {
        $registration = Registration::findOrFail($id);
        $registration->status = $request->status;
        $registration->save();

        return back()->with('success', 'Status updated manually.');
    }
}
