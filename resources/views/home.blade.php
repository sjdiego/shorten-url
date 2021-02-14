@extends('layouts.app')

@section('title', 'Shortener URL')

@section('content')
    <div class="container">
        <div class="flex flex-col items-center py-12">
            <h1 class="font-sans font-medium text-4xl antialiased">Shortener URL</h1>
            <h2 class="font-mono font-light text-lg antialiased">Another URL shortener</h2>
        </div>

        @include('components.shortener-form')
    </div>
@endsection