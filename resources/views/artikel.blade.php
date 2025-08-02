<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artikel - HaloBeluk</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=libre-baskerville:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-image: url('{{ asset('images/background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .article-card {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
            padding: 2rem;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .judul {
            font-family: 'Libre Baskerville', serif;
        }
    </style>
</head>
<body class="text-gray-900 flex flex-col min-h-screen">
    <div class="overlay min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-3xl w-full article-card">
            <h1 class="text-4xl font-bold judul mb-3 text-center text-gray-800">{{ $artikel->judul }}</h1>
            <p class="text-sm text-gray-600 text-center mb-4">Dipublikasikan pada {{ \Carbon\Carbon::parse($artikel->diterbitkan_pada)->format('d M Y') }}</p>

            @if($artikel->gambar)
                <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="Gambar Artikel" class="w-full h-auto rounded-lg mb-6">
            @endif

            <div class="prose max-w-none dark:prose-invert text-justify">
                {!! nl2br(e($artikel->konten)) !!}
            </div>
        </div>
    </div>
</body>
</html>
