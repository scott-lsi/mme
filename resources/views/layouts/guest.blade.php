<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title : env('APP_NAME') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script> function onSubmit(token) {document.getElementById("demo-form").submit();} </script>


    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="flex bg-gray-100">
            <div class="w-full bg-white overflow-hidden ">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>