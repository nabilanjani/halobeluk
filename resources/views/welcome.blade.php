<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HaloBeluk</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=libre-baskerville:400,700" rel="stylesheet" />

    <!-- Alpine.js untuk navbar responsive -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-green-50/60 backdrop-blur-lg shadow-md sticky top-0 z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
            <h1 class="text-lg font-bold text-green-800">Halo Beluk!</h1>

            <!-- Tombol hamburger (mobile) -->
            <button @click="open = !open" class="md:hidden text-green-800 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Navigasi desktop -->
            <nav class="hidden md:flex space-x-6 text-sm font-medium text-gray-700">
                <a href="{{ route('welcome') }}" class="hover:text-green-600 transition {{ request()->routeIs('welcome') ? 'text-green-700 font-semibold' : '' }}">Beranda</a>
                <a href="{{ route('kwt') }}" class="hover:text-green-600 transition {{ request()->routeIs('kwt') ? 'text-green-700 font-semibold' : '' }}">KWT Beluk</a>
                <a href="{{ route('maggot') }}" class="hover:text-green-600 transition {{ request()->routeIs('maggot') ? 'text-green-700 font-semibold' : '' }}">Artikel</a>
            </nav>

            @if (Route::has('login'))
                <div class="hidden md:block text-sm">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-800 hover:text-blue-600 font-semibold">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-800 hover:text-green-600 font-semibold">Login</a>
                    @endauth
                </div>
            @endif
        </div>

        <!-- Dropdown Mobile Menu -->
        <div class="md:hidden px-6 pb-4 pt-2 space-y-2 text-sm font-medium text-gray-700" x-show="open" x-transition>
            <a href="{{ route('welcome') }}" class="block hover:text-green-600 {{ request()->routeIs('welcome') ? 'text-green-700 font-semibold' : '' }}">Beranda</a>
            <a href="{{ route('kwt') }}" class="block hover:text-green-600 {{ request()->routeIs('kwt') ? 'text-green-700 font-semibold' : '' }}">KWT Beluk</a>
            <a href="{{ route('maggot') }}" class="block hover:text-green-600 {{ request()->routeIs('maggot') ? 'text-green-700 font-semibold' : '' }}">Artikel</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="block text-gray-800 hover:text-blue-600 font-semibold">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block text-gray-800 hover:text-green-600 font-semibold">Login</a>
                @endauth
            @endif
        </div>
    </header>

    <!-- Section dengan background gambar & konten di atasnya -->
    <section class="relative w-full min-h-screen bg-cover bg-center flex items-center justify-center text-white px-4" style="background-image: url('{{ asset('img/layang.jpg') }}');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/40 z-0"></div>

        <!-- Konten di atas background -->
        <div class="relative z-10 max-w-screen-xl w-full py-16">
            <div class="text-center mb-12">
                <h1 class="typing text-3xl lg:text-5xl font-bold">Halo Beluk!</h1>
                <h3 class="mt-2 text-1xl lg:text-3xl font-light">Beluk Berseri Nanas Lestari</h3>
            </div>

            <!-- Cards -->
            <div class="py-8 px-4 mt-2 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-6 lg:mb-16">
                    @foreach ($produks as $produk)
                        <div class="bg-gradient-to-b from-white/10 via-gray-900/30 to-gray-900/70 dark:from-gray-800 dark:to-gray-900 p-4 rounded-2xl shadow-lg hover:scale-105 transition-transform duration-300 hover:ring-2 hover:ring-yellow-500 relative overflow-hidden group">
                            <img src="{{ asset('storage/' . $produk->foto) }}" alt="Gambar Produk" class="w-full h-40 object-cover rounded-lg mb-4">
                            <h3 class="text-sm font-semibold text-white">{{ $produk->nama_produk }}</h3>
                            <p class="text-xs text-white mt-2">oleh {{ $produk->shop->name }}</p>
                            <p class="text-xl font-bold bg-gradient-to-r text-white bg-clip-text py-2 px-4 rounded-full mt-2 shadow-lg hover:shadow-2xl">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </p>
                            <div class="mt-2">
                                <a href="{{ $produk->shop->link }}?text=Halo%2C%20saya%20tertarik%20dengan%20produkmu%21" class="inline-block text-sm text-green-600 bg-white py-2 px-4 rounded-full border border-green-600 hover:bg-green-600 hover:text-white transition duration-300">
                                    Hubungi Toko
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white text-center py-4 text-sm border-t text-green-600 mt-auto">
        &copy; {{ date('Y') }} Desa Beluk • Made With ♡ By KKN-T 88 Universitas Diponegoro
    </footer>

    <style>
        .typing {
            display: inline-block;
            white-space: nowrap;
            overflow: hidden;
            animation: typing 3s steps(40) infinite, no-blink 0s step-end infinite;
        }
    </style>
</body>
</html>
