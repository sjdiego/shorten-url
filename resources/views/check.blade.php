@extends('layouts.app')

@section('title', env('APP_NAME', 'Shortener URL'))

@section('content')
    <div class="flex items-center">
        <div class="container flex flex-col md:flex-row px-5 mt-10 md:mt-40 text-gray-700">
            <div class="max-w-lg">
                <div id="redirection-url" data-code="{{ $code }}"></div>
            </div>
        </div>
    </div>
@endsection
