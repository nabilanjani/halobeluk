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

    <!-- Header -->
    <header class="bg-green-50 shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
            <h1 class="text-1xl font-bold text-green-800">Halo Beluk!</h1>

            <nav class="hidden md:flex space-x-6 text-sm font-medium text-gray-700">
                <a href="{{ route('welcome') }}" class="hover:text-green-600 transition {{ request()->routeIs('welcome') ? 'text-green-700 font-semibold' : '' }}">Beranda</a>
                <a href="{{ route('kwt') }}" class="hover:text-green-600 transition {{ request()->routeIs('kwt') ? 'text-green-700 font-semibold' : '' }}">KWT Beluk</a>
                <a href="{{ route('maggot') }}" class="hover:text-green-600 transition {{ request()->routeIs('maggot') ? 'text-green-700 font-semibold' : '' }}">Artikel</a>
            </nav>

            @if (Route::has('login'))
                <div class="text-sm">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-800 hover:text-blue-600 font-semibold">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-800 hover:text-green-600 font-semibold">Login</a>
                    @endauth
                </div>
            @endif
        </div>
    </header>

    <!-- Main Section with Background Image -->
    <section class="relative w-full min-h-screen bg-cover bg-center flex flex-col items-center justify-start text-white px-4" style="background-image: url('{{ asset('img/flower.jpeg') }}');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/40 z-0"></div>

        <!-- Content Above Background -->
        <div class="relative z-10 text-center max-w-4xl mx-auto py-16 px-4">
            <h1 class="text-3xl lg:text-5xl font-bold mb-6">Tentang Kelompok Wanita Tani</h1>
            <p class="mt-2 text-lg font-light leading-relaxed text-white">
                Kelompok Wanita Tani (KWT) adalah sebuah wadah pemberdayaan perempuan di Beluk yang dibentuk untuk meningkatkan keterampilan, produktivitas, dan kesejahteraan, khususnya para ibu rumah tangga di lingkungan Beluk.
                Lebih dari sekadar kelompok kerja, KWT menjadi ruang solidaritas dan pembelajaran bersama, tempat saling berbagi pengetahuan, pengalaman, dan semangat untuk mandiri secara ekonomi.
                Dengan semangat gotong royong, keberlanjutan, dan inovasi, Kelompok Wanita Tani menjadi salah satu ujung tombak dalam mendorong ketahanan pangan lokal, pengurangan limbah hasil tani, serta pengembangan ekonomi kreatif berbasis potensi desa.
            </p>
        </div>

        <!-- Shop List Section (now directly in the background section) -->
        <div class="relative mt-0 z-10 w-full px-6 py-16">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-1">
                @foreach ($shops as $shop)
                    <div class="bg-gray-100 bg-opacity-50 p-6 rounded-lg shadow-md">
                        <div class="flex items-center mb-6 space-x-6">
                            <!-- Gambar di Kiri -->
                            <div class="flex-shrink-0 w-40 h-40">
                                <img src="{{ asset('storage/' . $shop->image_path) }}" alt="Gambar Toko" class="object-cover w-full h-full rounded-full">
                            </div>

                            <!-- Deskripsi di Kanan -->
                            <div class="flex-grow">
                                <h3 class="text-xl font-semibold text-gray-800">{{ $shop->name }}</h3>
                                <p class="text-gray-900 mt-4">
                                    {{ $shop->name }} adalah Kelompok Wanita Tani yang berlokasi di {{ $shop->address }}, dipimpin oleh Ibu {{ $shop->owner_name }}. Kelompok ini bergerak dalam pemberdayaan perempuan melalui kegiatan pertanian dan pengolahan hasil tani lokal.
                                    Dengan semangat kebersamaan dan kepedulian terhadap potensi desa, {{ $shop->name }} terus berinovasi untuk menghadirkan berbagai karya yang bermanfaat bagi masyarakat.
                                    Untuk informasi lebih lanjut atau jika ingin bekerja sama, hubungi di nomor {{ $shop->phone_number }}.
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white text-center py-4 text-sm border-t text-green-600 mt-auto">
        &copy; {{ date('Y') }} Desa Beluk • Made With ♡ By KKN-T 88 Universitas Diponegoro
    </footer>

</body>
</html>
