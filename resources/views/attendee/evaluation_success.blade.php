@extends('layouts.guest')

@section('name', 'Evaluation Submitted')

@section('content')
<div class="text-center py-20">

    <h1 class="text-3xl font-bold text-blue-600 mb-4">Thank you!</h1>

    <p class="text-lg text-gray-700 dark:text-gray-300 mb-8">
        Your evaluation has been successfully submitted.
    </p>

    <a href="/"
       class="inline-block px-6 py-3 bg-blue-600 text-white text-lg rounded-lg hover:bg-blue-700 transition">
        Done
    </a>

</div>
@endsection