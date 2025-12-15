<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fashion Icon Pwt — Website</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap"
    rel="stylesheet" />
  <style>
    * {
      font-family: "Inter", sans-serif;
    }

    body {
      letter-spacing: -0.01em;
    }

    .nav-link {
      position: relative;
    }

    .nav-link::after {
      content: "";
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 1px;
      background: currentColor;
      transition: width 0.3s ease;
    }

    .nav-link:hover::after {
      width: 100%;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
      background: #c1c1c1;
      border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #a1a1a1;
    }

    /* Firefox Scrollbar */
    * {
      scrollbar-width: thin;
      scrollbar-color: #c1c1c1 #f1f1f1;
    }
  </style>
</head>

<body class="bg-white text-gray-900 antialiased">
  @php
  $products = $products ?? collect();
  $categories = $categories ?? collect();
  @endphp

  <!-- Navbar -->
  @include('homepage.layouts.navbar')

  <!-- Hero Section -->
  <section class="pt-16 relative">
    <!-- Main Hero Container -->
    <div class="relative h-[90vh] bg-gray-900">
      <!-- Hero Image -->
      <div class="absolute inset-0">
        <img
          src="{{ asset('hero/hero.jpeg') }}"
          alt="Hero Fashion"
          class="w-full h-full object-cover" />

        <!-- Simple Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/30 to-black/60"></div>
      </div>

      <!-- Content Container - Centered -->
      <div class="relative h-full flex items-center justify-center">
        <div class="text-center px-6 max-w-3xl mx-auto">

          <!-- Small Badge -->
          <div class="flex items-center justify-center space-x-2 mb-6">
            <div class="h-px w-12 bg-white/60"></div>
            <span class="text-xs tracking-[0.25em] text-white/90 font-light uppercase">Koleksi Terbaik</span>
            <div class="h-px w-12 bg-white/60"></div>
          </div>

          <!-- Main Heading -->
          <h1 class="text-5xl md:text-7xl font-light text-white leading-tight tracking-tight mb-6">
            Fashion Icon Purwokerto
          </h1>

          <!-- Description -->
          <p class="text-lg text-white/80 font-light leading-relaxed mb-10 max-w-2xl mx-auto">
            Dipercaya banyak pelanggan sebagai pilihan utama fashion di Purwokerto. </p>

          <!-- CTA Button -->
          <a href="/product"
            class="inline-flex items-center justify-center px-8 py-4 bg-white text-gray-900 rounded-xl font-medium text-sm hover:bg-gray-100 transition-colors">
            <span>Jelajahi Koleksi</span>
          </a>
        </div>
      </div>

      <!-- Simple Scroll Indicator -->
      <div class="absolute bottom-8 left-1/2 -translate-x-1/2">
        <div class="flex flex-col items-center space-y-2 text-white/60">
          <span class="text-xs uppercase tracking-wider">Scroll</span>
          <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
          </svg>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 grid md:grid-cols-2 gap-14 items-center">

      <!-- Image -->
      <div class="flex justify-center">
        <img
          src="{{ asset('hero/about.png') }}"
          alt="About Fashion Icon Purwokerto"
          class="w-full max-w-sm rounded-2xl object-cover shadow-lg">
      </div>

      <!-- Text -->
      <div>
        <h2 class="text-3xl md:text-4xl font-light mb-6">
          Hai Kami Fashion Icon Purwokerto
        </h2>

        <p class="text-gray-600 leading-relaxed mb-4">
          Fashion Icon Purwokerto adalah brand fashion lokal yang menghadirkan produk modern, nyaman, dan mudah dipadupadankan untuk berbagai kebutuhan sehari-hari.
        </p>

        <p class="text-gray-600 leading-relaxed mb-4">
          Kami mengutamakan kualitas serta selalu mengikuti perkembangan tren fashion terkini untuk memberikan pilihan terbaik bagi pelanggan.
        </p>

        <p class="text-gray-600 leading-relaxed">
          Berlokasi di <strong>Jalan HR Bunyamin No.181, Purwokerto</strong>, kami berusaha memberikan pengalaman belanja yang nyaman dan pelayanan profesional.
        </p>
      </div>

    </div>
  </section>


  <!-- Categories Section -->
  <section id="categories" class="bg-gray-100 w-full py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <h2 class="text-center text-3xl font-light tracking-tight mb-10">
        Kategori Produk
      </h2>

      <div class="flex flex-row flex-wrap items-center justify-center gap-4">
        @if($categories->isEmpty())
        <p class="text-center text-gray-500">Tidak ada kategori yang tersedia.</p>
        @else
        @foreach ($categories as $category)
        <a href="{{ route('categories.show', $category->slug) }}"
          class="flex flex-col md:flex-row items-center justify-center md:justify-start gap-4 
                               h-14 px-4 md:border border-slate-200 hover:border-red-600 rounded-lg transition">

          <img src="{{ $category->image ? Storage::url($category->image) : 'https://via.placeholder.com/80?text=Icon' }}"
            alt="{{ $category->name }}"
            class="w-10 h-10 object-scale-down" />

          <span class="font-medium text-sm">
            {{ $category->name }}
          </span>
        </a>
        @endforeach
        @endif
      </div>
    </div>
  </section>


  <!-- Featured Products Section -->
  <section id="featured-products" class="max-w-7xl mx-auto px-6 lg:px-8 py-10 border-t border-gray-100">
    <h2 class="text-center text-3xl font-light tracking-tight mb-4">
      Produk kami
    </h2>
    <div class="text-center mb-5">
      <a href="{{ route('products.index') }}" class="text-sm hover:underline">
        Lihat Semua
      </a>
    </div>

    <!-- Grid Produk -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-12">
      @forelse($products as $product)
      <div class="group">
        <a href="{{ route('products.show', $product->slug) }}"
          class="block relative overflow-hidden bg-gray-50 aspect-[3/4] mb-4 rounded-xl overflow-hidden">
          <img src="{{ $product->main_image ? Storage::url($product->main_image) : 'https://via.placeholder.com/500x600?text=No+Image' }}"
            alt="{{ $product->name }}"
            class="w-full h-full object-cover group-hover:scale-105 transition duration-700" />
        </a>
        <div class="space-y-1">
          <p class="text-xs text-gray-500 uppercase">{{ $product->category->name ?? 'Uncategorized' }}</p>
          <h3 class="text-sm font-medium">{{ $product->name }}</h3>
          <p class="text-sm text-gray-500">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        </div>
      </div>
      @empty
      <p class="col-span-full text-center text-gray-500">Produk tidak tersedia.</p>
      @endforelse
    </div>

    <!-- Pagination -->
    @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="mt-6 flex justify-center">
      {{ $products->links() }}
    </div>
    @endif
  </section>

  <!-- Store Location Section -->
  <section id="location" class="bg-gradient-to-b from-gray-50 to-white py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

      <!-- Header -->
      <div class="text-center mb-12">
        <h2 class="text-3xl font-light tracking-tight text-gray-900 mb-3">Kunjungi Toko Kami</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">
          Temukan koleksi fashion terlengkap di lokasi kami atau hubungi untuk informasi lebih lanjut
        </p>
      </div>

      <div class="grid lg:grid-cols-5 gap-8">

        <!-- Left: Store Info -->
        <div class="lg:col-span-2 space-y-6">

          <!-- Main Info Card -->
          <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
            <div class="flex items-start gap-4 mb-6">
              <div class="flex-shrink-0 w-12 h-12 bg-gray-900 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
              </div>
              <div>
                <h3 class="text-lg font-medium text-gray-900 mb-1">Fashion Icon Purwokerto</h3>
                <p class="text-sm text-gray-500">Toko Fashion Terlangkap Purwokerto</p>
              </div>
            </div>

            <div class="space-y-4">
              <!-- Address -->
              <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <div>
                  <p class="text-sm font-medium text-gray-900 mb-1">Alamat</p>
                  <p class="text-sm text-gray-600">Jalan HR Bunyamin No.181, Purwokerto Utara, Kabupaten Banyumas,.</p>
                </div>
              </div>

              <!-- Phone -->
              <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <div>
                  <p class="text-sm font-medium text-gray-900 mb-1">Telepon</p>
                  <a href="tel:081234567890" class="text-sm text-gray-600 hover:text-gray-900">0812-3456-7890</a>
                </div>
              </div>

              <!-- Hours -->
              <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                  <p class="text-sm font-medium text-gray-900 mb-1">Jam Operasional</p>
                  <p class="text-sm text-gray-600">Senin - Minggu: 09:00 - 21:30</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Action Buttons -->
          <div class="grid grid-cols-2 gap-3">
            <a href="https://wa.me/6285959628181" target="_blank"
              class="flex items-center justify-center gap-2 px-4 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-all shadow-sm hover:shadow-md">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
              </svg>
              <span class="text-sm font-medium">WhatsApp</span>
            </a>

            <a href="https://maps.google.com/?q=Fashion+Icon+Purwokerto" target="_blank"
              class="flex items-center justify-center gap-2 px-4 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-all shadow-sm hover:shadow-md">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
              </svg>
              <span class="text-sm font-medium">Petunjuk Arah</span>
            </a>
          </div>

          <!-- Info Badge -->
          <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
            <div class="flex gap-3">
              <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <div>
                <p class="text-sm font-medium text-blue-900">Parkir Tersedia</p>
                <p class="text-xs text-blue-700 mt-1">Area parkir luas & gratis untuk pengunjung</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Right: Map -->
        <div class="lg:col-span-3">
          <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm h-full min-h-[500px] relative">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.63881477423!2d109.2420653743161!3d-7.3943065727978246!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655e891bddeb9b%3A0xee811d706e25b949!2sFashion%20Icon%20Purwokerto!5e0!3m2!1sid!2sid!4v1765013807711!5m2!1sid!2sid"
              class="absolute top-0 left-0 w-full h-full"
              style="border: 0;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>

      </div>
    </div>
  </section>


  <!-- Footer -->
  @include('homepage.layouts.footer')

</body>
<script>
  document.getElementById("menuBtn").addEventListener("click", function() {
    document.getElementById("mobileMenu").classList.toggle("hidden");
  });
</script>

</html>