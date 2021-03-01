<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', env('APP_NAME', 'Backend'))</title>
    <link href="{{ mix('css/backend.css') }}" rel="stylesheet">
</head>
<body>
    <div class="h-screen w-screen bg-gray-100">
        @inertia
    </div>

    <script src="{{ mix('js/backend/app.js') }}" defer></script>
</body>
</html>
