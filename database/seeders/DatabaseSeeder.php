<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\Registration;
use App\Models\Pitching;
use App\Models\Attendance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create the Event
        $event = Event::create([
            'name' => 'Cotabato DigiWork Expo 2026',
            'description' => 'A comprehensive event featuring multiple workshops',
            'venue' => 'University of Southern Mindanao',
            'start_date' => now()->addDays(5),
            'end_date' => now()->addDays(7),
        ]);

        // 2. Create an Admin
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        // 3. Define some variations for testing search
        $names = ['Juan Dela Cruz', 'Maria Santos', 'Robert Smith', 'Ali Ibrahim', 'Sarah Connor'];
        $affiliations = ['USM', 'DICT', 'Local Startup', 'MSU', 'Freelancer'];
        $groups = ['Tech Innovators', 'Digital Nomads', 'Green Solutions', null, null];

        foreach ($names as $index => $name) {
            // Create the Attendee
            $user = User::create([
                'name' => $name,
                'email' => strtolower(str_replace(' ', '.', $name)) . '@example.com',
                'password' => bcrypt('password'),
                'affiliation' => $affiliations[$index],
            ]);

            // Create the Registration
            $registration = Registration::create([
                'attendee_id' => $user->id,
                'event_id' => $event->id,
                'registered_date' => now(),
                'status' => 'checked_in',
                'qr_code_value' => Str::random(10),
                'exhibit_product' => ($index % 2 == 0) ? 'Smart Agriculture Bot' : 'Not Participating',
            ]);

            // Create Pitching Info if the group isn't null
            if ($groups[$index]) {
                Pitching::create([
                    'registration_id' => $registration->id,
                    'group_name' => $groups[$index],
                    'organization' => $affiliations[$index],
                    'team_members' => 'Member 1, Member 2',
                ]);
            }

            // 4. Create Attendance Logs (The data for your Log page)
            // Log for the Event
            Attendance::create([
                'registration_id' => $registration->id,
                'for' => 'event',
                'created_at' => now()->subMinutes(rand(1, 100)),
            ]);

            // If they have a pitching group, log them for pitching too
            if ($groups[$index]) {
                Attendance::create([
                    'registration_id' => $registration->id,
                    'for' => 'pitching',
                    'created_at' => now()->subMinutes(rand(1, 50)),
                ]);
            }
        }
    }
}