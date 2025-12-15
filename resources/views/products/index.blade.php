@extends('homepage.index')
@section('content')

<!-- PAGE HEADER -->
<section class="pt-24 pb-8 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <h1 class="text-3xl font-light tracking-tight mb-2">Produk Kami</h1>
        <p class="text-sm text-gray-500">Temukan pakaian berkualitas untuk gaya Anda</p>
    </div>
</section>

<!-- FILTER & CATEGORY -->
<section class="border-b border-gray-100 sticky top-16 bg-white z-40">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-start py-4 overflow-x-auto gap-4">
            <!-- Semua Kategori -->
            <a href="{{ route('products.index') }}"
                class="category-btn text-sm {{ !isset($categoryActive) ? 'text-gray-900 font-medium border-b-2 border-gray-900' : 'text-gray-500 border-b-2 border-transparent hover:text-gray-900' }} whitespace-nowrap pb-1">
                Semua
            </a>

            <!-- Kategori Dinamis -->
            @foreach($categories as $cat)
            <a href="{{ route('products.byCategory', ['slug' => $cat->slug]) }}">
                {{ $cat->name }}
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- PRODUCTS GRID -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        @if($products->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-12">
            @foreach($products as $product)
            <div class="group">
                <a href="{{ route('products.show', ['slug' => $product->slug]) }}" class="block relative overflow-hidden bg-gray-50 rounded-xl aspect-[3/4] mb-4">
                    <img src="{{ $product->main_image ? Storage::url($product->main_image) : 'https://via.placeholder.com/500x600?text=No+Image' }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700" />
                </a>
                <div class="space-y-1">
                    <p class="text-xs text-gray-500 uppercase">{{ $product->category->name ?? '-' }}</p>
                    <h3 class="text-sm font-medium">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-500">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
        @else
        <p class="text-center text-gray-500 mt-12">Belum ada produk untuk kategori ini.</p>
        @endif
    </div>
</section>

@endsection