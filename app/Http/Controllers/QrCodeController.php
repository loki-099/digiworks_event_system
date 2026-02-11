<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    //
    // public function downloadQRCode()
    // {
    //     $image = QrCode::format('png')
    //         ->size(300)
    //         ->generate('https://your-website.com');

    //     return response()->streamDownload(function () use ($image) {
    //         echo $image;
    //     }, 'qrcode.png');
    // }
}
