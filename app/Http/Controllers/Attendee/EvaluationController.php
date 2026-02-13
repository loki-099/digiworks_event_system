<?php

namespace App\Http\Controllers\Attendee;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvaluationRequest;
use App\Models\Evaluation;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EvaluationController extends Controller
{
    /**
     * Show the public evaluation form after QR scan.
     */
    public function showForm(): View
    {
        // Simply display the form — no token needed
        return view('attendee.evaluate');
    }

    /**
     * Handle submission of evaluation form.
     */
    public function submit(StoreEvaluationRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $email = $data['email'];

        // STEP 1 — find user by email
        $user = User::where('email', $email)->first();
        if (!$user) {
            return back()
                ->withErrors(['email' => 'This email does not exist in our system.'])
                ->withInput();
        }

        // STEP 2 — verify this user is registered for the event
        $registration = Registration::where('attendee_id', $user->id)->first();
        if (!$registration) {
            return back()
                ->withErrors(['email' => 'This email is not registered for the event.'])
                ->withInput();
        }

        // STEP 3 — check if already evaluated
        $existing = Evaluation::where('registration_id', $registration->id)->first();
        if ($existing) {
            return back()->with('message', 'You have already evaluated the event.');
        }

        // STEP 4 — store evaluation
        Evaluation::create([
            'registration_id' => $registration->id,
            'attendee_id'     => $user->id,
            'event_id'        => $registration->event_id,
            'rating'          => $data['rating'],
            'comments'        => $data['comments'] ?? null,
        ]);

        return redirect()->route('evaluate.success');
    }
}
