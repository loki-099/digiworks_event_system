<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Event Registration QR Code</title>
</head>
<body style="font-family: Arial, sans-serif; text-align: center;">

    <h2>You're registered for Cotabato ICT Summit 🎉</h2>

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
    <p>
       <strong>Event Details:</strong><br>
        University Of Southern Mindanao - Kabacan Campus<br>
        March 2-3, 2026<br>
    </p>

    <br>

    <small>
        Cotabato ICT Summit Event Team  
    </small>

</body>
</html>
