@extends('layouts.app')

@section('title', 'Redirecting...')

@section('content')
<div class="flex items-center">
    <div class="container flex flex-col md:flex-row items-center justify-center px-5 mt-10 md:mt-40 text-gray-700">
        <div class="max-w-lg">
            <p class="text-2xl md:text-3xl font-light leading-normal">Please wait...</p>
            <p class="text-lg mb-4">You are being redirected to:</p>
            <p class="text-sm font-mono whitespace-normal break-normal md:break-all">https://google.com/?q=test&param=value&abc=123,456,789&utm_param=1</p>
        </div>
    </div>
</div>
@endsection