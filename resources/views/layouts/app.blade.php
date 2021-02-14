<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'URL Shortener')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="root">
        <div class="h-screen w-screen bg-gray-100">
            @yield('content')        
        </div>
    </div>

    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>