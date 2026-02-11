<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class RegistrationQRCodeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $event;
    public $registration;

    public function __construct(User $user, Event $event, Registration $registration)
    {
        $this->user = $user;
        $this->event = $event;
        $this->registration = $registration;
    }

    public function build()
    {
        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'scale' => 6,
            'imageBase64' => false,
        ]);

        $qrBinary = (new QRCode($options))->render($this->registration->qr_code_value);

        return $this->subject('Your DigiWorks Event QR Code')
            ->view('emails.registration_qr')
            ->with([
                'user' => $this->user,
                'event' => $this->event,
                'qrBinary' => $qrBinary,
            ]);
    }
}
