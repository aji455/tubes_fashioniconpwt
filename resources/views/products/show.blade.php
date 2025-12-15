@extends('homepage.index')

@section('content')
<div class="pt-20 pb-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-8">
            <a href="/" class="hover:text-gray-900 transition">Beranda</a>
            <span>/</span>
            <a href="/#featured-products" class="hover:text-gray-900 transition">Produk</a>
            <span>/</span>
            <span class="text-gray-900">{{ $product->name }}</span>
        </nav>

        <!-- Product Detail Section -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                <!-- Product Image -->
                <div class="relative bg-gray-100 aspect-square lg:aspect-auto">
                    <img src="{{ $product->main_image ? Storage::url($product->main_image) : 'https://via.placeholder.com/800x800?text=No+Image' }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover" />

                    @if($product->stock < 10 && $product->stock > 0)
                        <div class="absolute top-4 left-4 bg-orange-500 text-white text-xs px-3 py-1 rounded-full">
                            Stok Terbatas
                        </div>
                        @elseif($product->stock == 0)
                        <div class="absolute top-4 left-4 bg-red-500 text-white text-xs px-3 py-1 rounded-full">
                            Habis
                        </div>
                        @endif
                </div>

                <!-- Product Info -->
                <div class="p-8 lg:p-12 flex flex-col justify-between">
                    <div class="space-y-6">
                        <!-- Category & Title -->
                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-500 mb-2">
                                {{ $product->category->name ?? 'Uncategorized' }}
                            </p>
                            <h1 class="text-3xl lg:text-4xl font-light tracking-tight text-gray-900 mb-4">
                                {{ $product->name }}
                            </h1>
                            <div class="h-px bg-gray-200 w-16"></div>
                        </div>

                        <!-- Price -->
                        <div class="py-4">
                            <p class="text-3xl font-light text-gray-900">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>

                        <!-- Description -->
                        @if($product->description)
                        <div class="prose prose-sm text-gray-600 leading-relaxed">
                            <p>{{ $product->description }}</p>
                        </div>
                        @endif

                        <!-- Options -->
                        <div class="space-y-5 pt-2">
                            <!-- Size Selection -->
                            @if(!empty($product->size) && is_array($product->size))
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-3">
                                    Pilih Ukuran
                                </label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($product->size as $size)
                                    <button type="button"
                                        class="size-option px-5 py-2.5 border border-gray-300 rounded-lg text-sm hover:border-gray-900 hover:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2"
                                        data-value="{{ $size }}">
                                        {{ $size }}
                                    </button>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Color Selection -->
                            @if(!empty($product->color) && is_array($product->color))
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-3">
                                    Pilih Warna
                                </label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($product->color as $color)
                                    <button type="button"
                                        class="color-option px-5 py-2.5 border border-gray-300 rounded-lg text-sm hover:border-gray-900 hover:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2"
                                        data-value="{{ $color }}">
                                        {{ $color }}
                                    </button>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Stock Info -->
                            <div class="flex items-center space-x-2 text-sm">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-600">
                                    @if($product->stock > 10)
                                    Stok ({{ $product->stock }} item)
                                    @else
                                    Stok habis
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Add to Cart Button -->
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <!-- HIDDEN INPUT FOR SIZE & COLOR -->
                        <input type="hidden" name="size" id="selected_size">
                        <input type="hidden" name="color" id="selected_color">

                        <label class="block text-sm mb-2">Jumlah:</label>
                        <input type="number" name="quantity" value="1" min="1"
                            class="w-full border border-gray-300 rounded px-3 py-2">

                        <button type="submit"
                            class="px-4 py-3 bg-black text-white rounded-lg w-full">
                            Tambah ke Keranjang
                        </button>
                    </form>



                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        @if($relatedProducts->count() > 0)
        <div class="mt-20">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-light tracking-tight text-gray-900">Produk Serupa</h2>
                    <p class="text-sm text-gray-500 mt-1">Dari kategori yang sama</p>
                </div>
                <a href="/#featured-products" class="text-sm text-gray-700 hover:text-gray-900 flex items-center space-x-1 group">
                    <span>Lihat Semua</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($relatedProducts as $item)
                <div class="group bg-white rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
                    <a href="{{ route('products.show', $item->slug) }}" class="block">
                        <div class="aspect-[3/4] overflow-hidden bg-gray-100">
                            <img src="{{ $item->main_image ? Storage::url($item->main_image) : 'https://via.placeholder.com/600x800?text=No+Image' }}"
                                alt="{{ $item->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        </div>
                        <div class="p-4 space-y-2">
                            <p class="text-xs uppercase tracking-wider text-gray-500">
                                {{ $item->category->name ?? 'Uncategorized' }}
                            </p>
                            <h3 class="text-sm font-medium text-gray-900 truncate group-hover:text-gray-600 transition">
                                {{ $item->name }}
                            </h3>
                            <p class="text-base font-light text-gray-900">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    // Size selection
    document.querySelectorAll('.size-option').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.size-option').forEach(btn => {
                btn.classList.remove('bg-gray-900', 'text-white', 'border-gray-900');
                btn.classList.add('border-gray-300');
            });
            this.classList.add('bg-gray-900', 'text-white', 'border-gray-900');
            this.classList.remove('border-gray-300');
            document.getElementById('selected_size').value = this.dataset.value;
        });
    });

    // Color selection
    document.querySelectorAll('.color-option').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.color-option').forEach(btn => {
                btn.classList.remove('bg-gray-900', 'text-white', 'border-gray-900');
                btn.classList.add('border-gray-300');
            });
            this.classList.add('bg-gray-900', 'text-white', 'border-gray-900');
            this.classList.remove('border-gray-300');
            document.getElementById('selected_color').value = this.dataset.value;
        });
    });



    // Auto-select first option if only one available
    if (document.querySelectorAll('.size-option').length === 1) {
        document.querySelector('.size-option').click();
    }
    if (document.querySelectorAll('.color-option').length === 1) {
        document.querySelector('.color-option').click();
    }
</script>
@endsection