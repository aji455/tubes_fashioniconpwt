<nav class="fixed top-0 w-full bg-white/80 backdrop-blur-md z-50 border-b border-gray-200/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14">

            <!-- Logo -->
            <a href="/#hero" class="text-lg font-medium tracking-wide text-gray-900">Fashion Icon Purwokerto</a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="/#hero" class="nav-link px-3 py-2 text-sm text-gray-600 hover:text-gray-900 rounded-md transition-colors">Beranda</a>
                <a href="/#about" class="nav-link px-3 py-2 text-sm text-gray-600 hover:text-gray-900 rounded-md transition-colors">Tentang</a>
                <a href="/#categories" class="nav-link px-3 py-2 text-sm text-gray-600 hover:text-gray-900 rounded-md transition-colors">Kategori</a>
                <a href="/#featured-products" class="nav-link px-3 py-2 text-sm text-gray-600 hover:text-gray-900 rounded-md transition-colors">Produk</a>
                <a href="/#location" class="nav-link px-3 py-2 text-sm text-gray-600 hover:text-gray-900 rounded-md transition-colors">Lokasi</a>
            </div>

            <!-- Right Icons -->
            <div class="flex items-center space-x-3">

                <!-- Search Icon -->
                <a href="/#profile" class="hidden md:flex items-center justify-center w-9 h-9 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </a>

                <!-- Cart -->
                <a href="{{ route('cart.index') }}" class="flex items-center justify-center w-9 h-9 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </a>

                <!-- Jika Belum Login -->
                @guest
                <a href="{{ route('login') }}" class="hidden md:block text-sm text-gray-600 hover:text-gray-900 px-3 py-1.5 transition-colors">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="hidden md:block px-4 py-1.5 bg-gray-900 text-white text-sm rounded-full hover:bg-gray-800 transition-all">
                    Daftar
                </a>
                @endguest

                <!-- Jika Sudah Login -->
                @auth
                <a href="/profile" class="hidden md:flex items-center justify-center w-9 h-9 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </a>
                @endauth

                <!-- Mobile Menu Button -->
                <button id="menuBtn" class="md:hidden flex items-center justify-center w-9 h-9 text-gray-600 hover:bg-gray-100 rounded-full transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden border-t border-gray-200/50 bg-white/95 backdrop-blur-md">
        <div class="px-4 py-6 space-y-1">

            <!-- Menu umum -->
            <a href="/" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md transition-colors">Beranda</a>
            <a href="/#about" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md transition-colors">Tentang</a>
            <a href="/#categories" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md transition-colors">Kategori</a>
            <a href="/#featured-products" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md transition-colors">Produk</a>
            <a href="/#location" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md transition-colors">Kontak</a>

            <!-- Divider -->
            <div class="pt-4 pb-2">
                <div class="border-t border-gray-200"></div>
            </div>

            <!-- Jika sudah login -->
            @auth
            <a href="/profile" class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Profil Saya
            </a>
            @endauth

            <!-- Jika belum login -->
            @guest
            <a href="{{ route('login') }}" class="flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                Masuk
            </a>
            <a href="{{ route('register') }}" class="flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-gray-800 transition-colors">
                Daftar Sekarang
            </a>
            @endguest
        </div>
    </div>
</nav>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                const isClickInside = menuBtn.contains(event.target) || mobileMenu.contains(event.target);
                if (!isClickInside && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.toggle('hidden');
                }
            });
        }
    });
</script>
@endpush