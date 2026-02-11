@extends('layouts.attendance')

@section('name', 'Attendance Event')

@section('content')
    <div>
        <div class="p-6 space-y-6 text-center">
            <div class="w-full max-w-xs sm:max-w-sm aspect-square mx-auto rounded-xl overflow-hidden shadow-lg">
                <div id="reader" class="w-full h-full"></div>
            </div>
            <p class="text-green-400 text-xl font-bold">Scanning...</p>
            <a href="{{ route('admin.dashboard') }}"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Back</a
                onclick="stopScanner()">
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const html5QrCode = new Html5Qrcode("reader");
        let isScanning = false;

        function startScanner() {
            if (isScanning) return;

            html5QrCode.start({
                    facingMode: "environment"
                }, {
                    fps: 10,
                    qrbox: 250
                },
                (decodedText) => {
                    console.log("Scanned:", decodedText);
                    var route = "{{ route('attendance.event') }}";
                    route = route.replace(/\/$/, '');
                    // Optional: auto-stop after successful scan
                    stopScanner();

                    // Redirect
                    // window.location.href = route + '/' + decodedText;
                    fetch(route + '/' + decodedText, {
                            method: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                /* your data here if needed */ })
                        })
                        .then(response => response.json())
                        .then(data => {
                            // handle success, maybe redirect or show a message
                            window.location.href = '/admin/attendance/event'; // or wherever you want
                            alert('Attendance updated successfully!');
                        })
                        .catch(error => {
                            // handle error
                            alert('Failed to update attendance.');
                        });

                }
            ).then(() => {
                isScanning = true;
            }).catch(err => {
                console.error("Camera start error:", err);
            });
        }

        function stopScanner() {
            if (!isScanning) return;

            html5QrCode.stop().then(() => {
                html5QrCode.clear();
                isScanning = false;
            }).catch(err => {
                console.error("Camera stop error:", err);
            });
        }

        window.onload = startScanner;
    </script>
@endsection
