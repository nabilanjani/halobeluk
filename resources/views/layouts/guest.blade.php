<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-serif text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative w-full"
        style="background-image: url('{{ asset('img/tangan.jpg') }}'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-black/10 backdrop-blur-sm z-0"></div>
            <div class="relative z-10 flex flex-col items-center w-full">
                <div>
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </div>
                <h1 class="text-4xl font-bold text-center text-white">Halo Beluk!</h1>
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>    
        </div>
    </body>
</html>
