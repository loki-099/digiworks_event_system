<?php

namespace App\Http\Controllers\Attendee;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationQRCodeMail;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;


class AttendeeDashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $event = Event::orderBy('start_date', 'desc')->first();

        $registration = Registration::firstOrCreate(
        [
            'attendee_id' => $user->id,
            'event_id' => $event->id,
        ],
        [
            'qr_code_value' => Str::uuid()->toString(),
            'status' => 'registered',
        ]
        );
        Mail::to($user->email)->send(new RegistrationQRCodeMail($user, $event, $registration));

        
        $qrvalue = Registration::where('attendee_id', $user->id)->value('qr_code_value');
        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'scale' => 8,
            'imageBase64' => true,
        ]);
        $qrcode = (new QRCode($options))->render($qrvalue);

        return view('attendee.dashboard', compact('qrcode'));
    }

}
