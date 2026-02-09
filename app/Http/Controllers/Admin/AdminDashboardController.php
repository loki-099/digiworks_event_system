<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User;
use PhpParser\Node\Expr\FuncCall;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $event = Event::all()->first();
        return view('admin.dashboard', compact('event'));
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

    public function updateEvent(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'venue' => 'required|string|max:255',
        ]);

        $event = Event::all()->first();
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

}
