@extends('homepage.index')

@section('content')

<section class="pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <h1 class="text-2xl font-light tracking-tight mb-8">Keranjang Belanja</h1>

        <div class="space-y-6">

            @forelse ($items as $item)
            <div class="border border-gray-200 rounded-xl p-6 hover:border-gray-300 transition">

                <div class="flex flex-col md:flex-row gap-6">

                    {{-- IMAGE --}}
                    <div class="w-24 h-24 bg-gray-100 rounded-xl overflow-hidden">
                        <img src="{{ $item->product->main_image ? asset('storage/'.$item->product->main_image) : 'https://via.placeholder.com/150' }}"
                            class="w-full h-full object-cover">
                    </div>

                    {{-- INFO --}}
                    <div class="flex-1">

                        <p class="text-sm font-medium">{{ $item->product->name }}</p>

                        <p class="text-xs text-gray-500 mt-1">
                            Size: <span class="font-medium">{{ $item->size }}</span> •
                            Color: <span class="font-medium">{{ $item->color }}</span>
                        </p>

                        <div class="flex items-center gap-6 mt-4">

                            {{-- QTY CONTROL --}}
                            <div class="flex items-center gap-3">

                                {{-- Decrease --}}
                                <form action="{{ route('cart.update', $item->row_id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                                    <button class="w-8 h-8 border border-gray-300 flex justify-center items-center rounded-md">-</button>
                                </form>

                                <span>{{ $item->quantity }}</span>

                                {{-- Increase --}}
                                <form action="{{ route('cart.update', $item->row_id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                    <button class="w-8 h-8 border border-gray-300 flex justify-center items-center rounded-md">+</button>
                                </form>

                            </div>

                            {{-- PRICE --}}
                            <p class="text-sm font-medium">
                                Rp {{ number_format($item->product->price, 0, ',', '.') }}
                            </p>

                        </div>
                    </div>

                    {{-- REMOVE --}}
                    <form action="{{ route('cart.remove', $item->row_id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="text-red-500 text-sm">Hapus</button>
                        <p class="text-primary mt-10 ">
                            Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                        </p>
                    </form>


                </div>

            </div>
            @empty
            <p class="text-sm text-gray-500">Keranjang masih kosong.</p>
            @endforelse

        </div>

        {{-- SUMMARY --}}
        @if ($items->count())
        @php
        $subtotal = $items->sum(fn($i) => $i->product->price * $i->quantity);
        $shipping = 0;
        $total = $subtotal + $shipping;
        @endphp

        <div class="mt-12 max-w-md ml-auto border border-gray-200 rounded-xl p-6">

            <h2 class="text-lg font-light mb-4">Ringkasan Belanja</h2>

            <div class="flex justify-between text-sm mb-2">
                <span>Subtotal</span>
                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between text-sm mb-2">
                <span>Ongkir</span>
                <span class="text-red-500">Belum dihitung</span>
            </div>

            <div class="border-t border-gray-200 my-4"></div>

            <div class="flex justify-between text-sm font-medium mb-6">
                <span>Total</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>

            <a href="{{ route('checkout.index') }}"
                class="block text-center bg-gray-900 text-white w-full py-3 text-sm hover:bg-gray-800 transition rounded-lg">
                Lanjutkan ke Checkout
            </a>

        </div>
        @endif

    </div>
</section>

@endsection