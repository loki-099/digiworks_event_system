<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Registration;
use App\Models\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'affiliation' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'affiliation' => $request->affiliation,
            'position' => $request->position,
        ]);

        // Create a registration record for the new user.
        // Fetch the first event and use its ID, workshop is null for now.
        $event = Event::first();
        Registration::create([
            'attendee_id' => $user->id,
            'event_id' => $event->id,
            'workshop_id' => null,
            'qr_code_value' => Str::uuid()->toString(),
            'status' => 'registered',
        ]);


        
        event(new Registered($user));

        Auth::login($user);

        return redirect(route('attendee.dashboard', absolute: false));
    }
}
