<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    $user = auth()->user();

    // 🔐 Admin login page
    if ($request->is('admin/login')) {
        if (!in_array($user->role, ['admin', 'facilitator'])) {
            auth()->logout();

            return back()->withErrors([
                'email' => 'Only admins and facilitators can log in here.',
            ]);
        }

        return redirect()->route('admin.dashboard');
    }

    // 🔐 Attendee login page (/login)
    if ($request->is('login')) {
        if ($user->role !== 'user') {
            auth()->logout();

            return back()->withErrors([
                'email' => 'Only attendees can log in here.',
            ]);
        }

        return redirect()->route('attendee.dashboard');
    }

    // Safety fallback
    auth()->logout();

    return back()->withErrors([
        'email' => 'Unauthorized login attempt.',
    ]);
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
