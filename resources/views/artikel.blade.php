<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $artikel->judul }} - HaloBeluk</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=libre-baskerville:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom, #f8fafc, #e2e8f0);
        }

        .hero-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            object-position: center;
            border-bottom-left-radius: 1rem;
            border-bottom-right-radius: 1rem;
        }

        .judul {
            font-family: 'Libre Baskerville', serif;
        }

        .artikel-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 1rem;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            margin-top: -80px;
            padding: 2.5rem;
            position: relative;
            z-index: 10;
        }

        @media (max-width: 640px) {
            .hero-image {
                height: 250px;
            }

            .artikel-container {
                padding: 1.5rem;
                margin-top: -60px;
            }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-start pb-12">
    
    {{-- Gambar artikel --}}
    @if($artikel->gambar)
        <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="Gambar Artikel" class="hero-image">
    @endif

    {{-- Konten artikel --}}
    <div class="max-w-3xl w-full px-4 artikel-container">
        <h1 class="text-3xl sm:text-4xl font-bold judul text-center text-gray-900 mb-3">
            {{ $artikel->judul }}
        </h1>
        <p class="text-center text-sm text-gray-500 mb-6">
            Dipublikasikan pada {{ \Carbon\Carbon::parse($artikel->diterbitkan_pada)->format('d M Y') }}
        </p>

        <div class="prose max-w-none prose-lg text-gray-800 dark:prose-invert leading-relaxed text-justify">
            {!! nl2br(e($artikel->konten)) !!}
        </div>
    </div>
</body>
</html>
