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
    <header class="bg-green-50/60 backdrop-blur-lg shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
            <!-- Kiri: Logo / Judul -->
            <h1 class="text-1xl font-bold text-green-800">Halo Beluk!</h1>

            <!-- Tengah: Navigasi Menu -->
            <nav class="hidden md:flex space-x-6 text-sm font-medium text-gray-700">
                <a href="{{ route('welcome') }}"
                    class="hover:text-green-600 transition {{ request()->routeIs('welcome') ? 'text-green-700 font-semibold' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('kwt') }}"
                    class="hover:text-green-600 transition {{ request()->routeIs('kwt') ? 'text-green-700 font-semibold' : '' }}">
                    KWT Beluk
                </a>
                <a href="{{ route('maggot') }}"
                    class="hover:text-green-600 transition {{ request()->routeIs('maggot') ? 'text-green-700 font-semibold' : '' }}">
                    Artikel
                </a>
            </nav>

            <!-- Kanan: Login / Dashboard -->
            @if (Route::has('login'))
                <div class="text-sm">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-800 hover:text-blue-600 font-semibold">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-800 hover:text-green-600 font-semibold">
                            Login
                        </a>
                    @endauth
                </div>
            @endif
        </div>
    </header>

    <!-- Section dengan background gambar & konten di atasnya -->
    <section class="relative w-full min-h-screen bg-cover bg-center flex items-center justify-center text-white px-4" style="background-image: url('{{ asset('img/layang.jpg') }}');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/40 z-0"></div>

        <!-- Konten di atas background -->
        <div class="relative z-10 max-w-screen-xl w-full py-16">
            <!-- Judul -->
            <div class="text-center mb-12">
                <h1 class="text-3xl lg:text-5xl font-bold">Beluk Bercerita</h1>
                <h3 class="mt-2 text-1xl lg:text-3xl font-light">Kisah Beluk Berkarya untuk Desa Berdaya</h3>
            </div>
            {{-- Tampilan Daftar Artikel --}}
            <div class="mb-4 grid gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
                @foreach ($artikels as $artikel)
                    <div class="rounded-lg border border-gray-200 bg-white p-6 bg-opacity-80 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <div class="h-56 w-full">
                            <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="Gambar Artikel" class="object-cover w-full h-full">
                        </div>
                        <div class="pt-6">
                        <a href="{{ route('artikel.show', $artikel->id) }}" class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $artikel->judul }}</a>

                        <ul class="mt-2 flex items-center gap-4">
                            <li class="flex items-center gap-2">
                            <svg class="w-[20px] h-[20px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.045 3.007 12.31 3a1.965 1.965 0 0 0-1.4.585l-7.33 7.394a2 2 0 0 0 0 2.805l6.573 6.631a1.957 1.957 0 0 0 1.4.585 1.965 1.965 0 0 0 1.4-.585l7.409-7.477A2 2 0 0 0 21 11.479v-5.5a2.972 2.972 0 0 0-2.955-2.972Zm-2.452 6.438a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                            </svg>
                            <p class="text-sm font-medium
                            @if($artikel->kategori == 'UMKM') bg-blue-100 text-blue-800 px-2.5 py-0.5 rounded
                            @elseif($artikel->kategori == 'Pemasaran') bg-green-100 text-green-800 px-2.5 py-0.5 rounded
                            @elseif($artikel->kategori == 'Maggot') bg-yellow-100 text-yellow-800 px-2.5 py-0.5 rounded
                            @elseif($artikel->kategori == 'Limbah') bg-red-100 text-red-800 px-2.5 py-0.5 rounded
                            @endif
                            ">
                                {{ $artikel->kategori }}
                            </p>
                            </li>
                            <li class="flex items-center gap-2">
                            <svg class="w-[20px] h-[20px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Diterbitkan {{ $artikel->diterbitkan_pada }}</p>
                            </li>
                        </ul>
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
