<?php

namespace App\Jobs;

use App\Mail\RegistrationQRCodeMail;
use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRegistrationQrMail implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $uniqueFor = 86400;

    public function __construct(public int $registrationId)
    {
    }

    public function uniqueId(): string
    {
        return (string) $this->registrationId;
    }

    public function handle(): void
    {
        $registration = Registration::with(['attendee', 'event'])->find($this->registrationId);

        if (! $registration || $registration->qr_mail_sent_at) {
            return;
        }

        if (! $registration->attendee || ! $registration->event || ! $registration->attendee->email) {
            return;
        }

        Mail::to($registration->attendee->email)->send(
            new RegistrationQRCodeMail($registration->attendee, $registration->event, $registration)
        );

        $registration->forceFill([
            'qr_mail_sent_at' => now(),
        ])->save();
    }
}
