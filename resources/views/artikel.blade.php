<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $artikel->judul }} - HaloBeluk</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            color: #111827;
        }

        .hero {
            position: relative;
            width: 100%;
            height: 60vh;
            overflow: hidden;
        }

        .hero img {
            object-fit: cover;
            width: 100%;
            height: 100%;
            filter: brightness(75%);
        }

        .hero-text {
            position: absolute;
            bottom: 20%;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            color: white;
        }

        .hero-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 600;
            line-height: 1.2;
        }

        .hero-text p {
            font-size: 0.9rem;
            margin-top: 0.5rem;
            opacity: 0.9;
        }

        .content {
            max-width: 700px;
            background-color: white;
            margin: -60px auto 60px auto;
            padding: 3rem 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
        }

        .content .prose {
            line-height: 1.75;
        }

        @media (max-width: 640px) {
            .hero-text h1 {
                font-size: 1.7rem;
            }

            .content {
                padding: 2rem 1rem;
                margin-top: -40px;
            }
        }
    </style>
</head>
<body>

    {{-- Hero Section --}}
    <section class="hero" data-aos="fade-in">
        @if($artikel->gambar)
            <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="Gambar Artikel">
        @endif
        <div class="hero-text">
            <h1>{{ $artikel->judul }}</h1>
            <p>Dipublikasikan pada {{ \Carbon\Carbon::parse($artikel->diterbitkan_pada)->format('d M Y') }}</p>
        </div>
    </section>

    {{-- Konten Artikel --}}
    <section class="content" data-aos="fade-up" data-aos-delay="100">
        <div class="prose prose-lg text-gray-800 dark:prose-invert text-justify">
            {!! nl2br(e($artikel->konten)) !!}
        </div>
    </section>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true });
    </script>
</body>
</html>
