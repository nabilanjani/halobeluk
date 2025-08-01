<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HaloBeluk</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=libre-baskerville:400,700" rel="stylesheet" />


    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="mt-8 text-3xl font-bold mb-4">{{ $artikel->judul }}</h1>
        <p class="text-sm text-gray-500 mb-2">Dipublikasikan pada {{ \Carbon\Carbon::parse($artikel->diterbitkan_pada)->format('d M Y') }}</p>

        @if($artikel->gambar)
            <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="Gambar Artikel" class="w-full h-auto rounded-lg mt-6 mb-6">
        @endif

        <div class="prose dark:prose-invert">
            {!! nl2br(e($artikel->konten)) !!}
        </div>
    </div>
</body>
</html>