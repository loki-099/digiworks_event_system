<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Event Registration QR Code</title>
</head>
<body style="font-family: Arial, sans-serif; text-align: center;">

    <h2>You're Registered for DigiWorks Event 🎉</h2>

    <p>Hello {{ $user->name }},</p>

    <p>
        Thank you for registering for <strong>{{ $event->name }}</strong>.
    </p>

    <p>
        Please present this QR code at the entrance:
    </p>

    <div style="margin: 20px 0;">
        <img src="{{ $message->embedData($qrBinary, 'qrcode.png', 'image/png') }}" alt="QR Code">
    </div>

    <p>
        Keep this email safe. Do not share your QR code.
    </p>

    <br>

    <small>
        DigiWorks Event Team  
        {{ config('app.name') }}
    </small>

</body>
</html>
