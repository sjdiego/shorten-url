@extends('layouts.app')

@section('title', '404 - Not found')

@section('content')
<div class="flex items-center">
    <div class="container flex flex-col md:flex-row items-center justify-center px-5 text-gray-700">
        <div class="max-w-md">
            <div class="text-5xl font-dark font-bold">404</div>
            <p class="text-2xl md:text-3xl font-light leading-normal">The page cannot be found.</p>
            <p class="mb-4">The requested resource doesn't exist in the application.</p>
            <a 
                href="{{ route('home') }}"
                class="px-4 inline py-2 text-sm font-medium leading-5 shadow text-white transition-colors duration-150 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-blue bg-blue-600 active:bg-blue-600 hover:bg-blue-700">
                Go to Home
            </a>
        </div>
        <div class="max-w-lg">
            @include('svg.catfail')
        </div>
    </div>
</div>
@endsection