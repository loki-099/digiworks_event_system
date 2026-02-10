<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create the default event
        Event::create([
            'name' => 'Cotabato DigiWork Expo 2026',
            'description' => 'A comprehensive event featuring multiple workshops',
            'venue' => 'University of Southern Mindanao',
            'start_date' => now()->addDays(5),
            'end_date' => now()->addDays(7),
        ]);

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
