<?php

use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Support\Str;

it('only shows form when valid QR token is provided', function () {
    $token = Str::uuid()->toString();

    $response = $this->get("/evaluate/{$token}");
    $response->assertStatus(404);

    // create a registration
    $user = User::factory()->create();
    $event = Event::create([
        'name' => 'Test Event',
        'description' => 'x',
        'venue' => 'y',
        'start_date' => now(),
        'end_date' => now()->addDay(),
    ]);
    Registration::create([
        'attendee_id' => $user->id,
        'event_id' => $event->id,
        'qr_code_value' => $token,
        'status' => 'registered',
    ]);

    $response = $this->get("/evaluate/{$token}");
    $response->assertStatus(200);
    $response->assertSee('Your email address');
});

it('rejects submissions when email not registered', function () {
    $token = Str::uuid()->toString();
    $user = User::factory()->create();
    $event = Event::create([
        'name' => 'Test Event',
        'description' => 'x',
        'venue' => 'y',
        'start_date' => now(),
        'end_date' => now()->addDay(),
    ]);
    Registration::create([
        'attendee_id' => $user->id,
        'event_id' => $event->id,
        'qr_code_value' => $token,
        'status' => 'registered',
    ]);

    $response = $this->post('/evaluate/submit', [
        'token' => $token,
        'email' => 'not@registered.test',
        'rating' => 4,
        'comments' => 'hello',
    ]);

    $response->assertSessionHasErrors('email');
});

it('stores evaluation on first submission and rejects second', function () {
    $token = Str::uuid()->toString();
    $user = User::factory()->create(['email' => 'john@example.com']);
    $event = Event::create([
        'name' => 'Test Event',
        'description' => 'x',
        'venue' => 'y',
        'start_date' => now(),
        'end_date' => now()->addDay(),
    ]);
    $registration = Registration::create([
        'attendee_id' => $user->id,
        'event_id' => $event->id,
        'qr_code_value' => $token,
        'status' => 'registered',
    ]);

    $this->post('/evaluate/submit', [
        'token' => $token,
        'email' => 'john@example.com',
        'rating' => 5,
        'comments' => 'Great!',
    ])->assertSessionHas('success');

    // second attempt
    $this->post('/evaluate/submit', [
        'token' => $token,
        'email' => 'john@example.com',
        'rating' => 3,
    ])->assertSessionHas('message');
});
