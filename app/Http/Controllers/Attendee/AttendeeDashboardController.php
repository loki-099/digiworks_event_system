<?php

namespace App\Http\Controllers\Attendee;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use App\Models\Workshop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AttendeeDashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $event = Event::orderBy('start_date', 'desc')->first();
        if (!$event) {
            $workshopWithEvent = Workshop::with('event')->first();
            $event = $workshopWithEvent?->event;
        }
        $workshops = collect();
        $registration = null;

        if ($event && $user) {
            $workshops = Workshop::where('event_id', $event->id)->get();

            $registration = Registration::with('workshop')
                ->where('attendee_id', $user->id)
                ->where('event_id', $event->id)
                ->first();

            if (!$registration) {
                $registration = Registration::create([
                    'attendee_id' => $user->id,
                    'event_id' => $event->id,
                    'workshop_id' => null,
                    'qr_code_value' => Str::uuid()->toString(),
                    'status' => 'registered',
                ]);
                $registration->load('workshop');
            }
        }

        return view('attendee.dashboard', compact('event', 'workshops', 'registration'));
    }

    public function joinWorkshop(Request $request, Workshop $workshop): RedirectResponse
    {
        $user = Auth::user();
        $event = $workshop->event;

        if (!$user || !$event) {
            return redirect()->route('attendee.dashboard');
        }

        $registration = Registration::where('attendee_id', $user->id)
            ->where('event_id', $event->id)
            ->first();

        if (!$registration) {
            $registration = Registration::create([
                'attendee_id' => $user->id,
                'event_id' => $event->id,
                'workshop_id' => null,
                'qr_code_value' => Str::uuid()->toString(),
                'status' => 'registered',
            ]);
        }

        if ($registration->workshop_id && $registration->workshop_id !== $workshop->id) {
            return redirect()->route('attendee.dashboard')
                ->with('error', 'You are already registered for another workshop.');
        }

        $registration->workshop_id = $workshop->id;
        $registration->save();

        return redirect()->route('attendee.dashboard')
            ->with('success', 'Workshop joined successfully.');
    }

    public function cancelWorkshop(Request $request, Workshop $workshop): RedirectResponse
    {
        $user = Auth::user();
        $event = $workshop->event;

        if (!$user || !$event) {
            return redirect()->route('attendee.dashboard');
        }

        $registration = Registration::where('attendee_id', $user->id)
            ->where('event_id', $event->id)
            ->first();

        if ($registration && $registration->workshop_id === $workshop->id) {
            $registration->workshop_id = null;
            $registration->save();
        }

        return redirect()->route('attendee.dashboard')
            ->with('success', 'Workshop canceled successfully.');
    }
}
