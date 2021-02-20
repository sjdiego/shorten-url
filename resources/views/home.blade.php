@extends('layouts.app')

@section('title', env('APP_NAME', 'Shortener URL'))

@section('content')
    <div class="container">
        <div class="flex flex-col items-center py-12" data-aos="fade">
            <h1 class="font-sans font-medium text-4xl antialiased">{{ env('APP_NAME', 'Shortener URL') }}</h1>
            <h2 class="font-mono font-light text-lg antialiased">Another URL shortener</h2>
        </div>
        <div id="create-shorten-form"></div>
    </div>
@endsection
