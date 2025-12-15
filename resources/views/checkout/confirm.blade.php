<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Konfirmasi Pesanan — Fashion Icon Purwokerto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <style>
        * {
            font-family: "Inter", sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            letter-spacing: -0.01em;
        }

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

        * {
            scrollbar-width: thin;
            scrollbar-color: #c1c1c1 #f1f1f1;
        }
    </style>
</head>

<body class="bg-gray-50 antialiased">

    <!-- Header -->
    <header class="bg-white border-b border-gray-200 py-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex items-center justify-between">
            <a href="/" class="text-xl font-light tracking-tight">Fashion Icon Purwokerto</a>
            <div class="flex items-center gap-8">
                <div class="hidden md:flex items-center gap-2 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full bg-gray-900 text-white flex items-center justify-center text-xs">✓</div>
                        <span class="text-gray-400">Checkout</span>
                    </div>
                    <div class="w-8 h-px bg-gray-900"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full bg-gray-900 text-white flex items-center justify-center text-xs">2</div>
                        <span class="text-gray-900">Konfirmasi pesanan</span>
                    </div>
                    <div class="w-8 h-px bg-gray-300"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-xs">3</div>
                        <span>Pembayaran</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

                <!-- Left Column - Order Details -->
                <div class="lg:col-span-7">

                    <!-- Informasi Pesanan -->
                    <div class="bg-white p-6 md:p-8 border border-gray-200 mb-6 rounded-xl">
                        <h2 class="text-lg font-medium mb-6">Informasi Pesanan</h2>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">ID Pesanan</p>
                                <p class="text-sm font-medium">#{{ $order->id }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 mb-1">Tanggal Pesanan</p>
                                <p class="text-sm font-medium">{{ $order->created_at->format('d F Y') }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 mb-1">Status Pesanan</p>
                                <p class="text-sm font-medium text-gray-900">{{ $order->status }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 mb-1">Status Pengiriman</p>
                                <p class="text-sm font-medium">{{ $order->shipping_status }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Pengiriman -->
                    <div class="bg-white p-6 md:p-8 border border-gray-200 mb-6 rounded-xl">
                        <h2 class="text-lg font-medium mb-6">Informasi Pengiriman</h2>

                        <div class="space-y-4">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Nama Lengkap</p>
                                <p class="text-sm">{{ $order->full_name }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 mb-1">Email</p>
                                <p class="text-sm">{{ $order->email }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 mb-1">Nomor Telepon</p>
                                <p class="text-sm">{{ $order->phone }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 mb-1">Alamat Lengkap</p>
                                <p class="text-sm">{{ $order->address }}</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Kota</p>
                                    <p class="text-sm">{{ $order->city }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Provinsi</p>
                                    <p class="text-sm">{{ $order->province }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Kode Pos</p>
                                    <p class="text-sm">{{ $order->postal_code }}</p>
                                </div>
                            </div>

                            @if($order->notes)
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Catatan Pesanan</p>
                                <p class="text-sm text-gray-600 italic">{{ $order->notes }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Metode Pengiriman -->
                    <div class="bg-white p-6 md:p-8 border border-gray-200 mb-6 rounded-xl">
                        <h2 class="text-lg font-medium mb-6">Metode Pengiriman</h2>

                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-xl">
                            <div>
                                <p class="text-sm font-medium">{{ $order->shippingCost->name }}</p>
                                <p class="text-xs text-gray-500">{{ $order->shippingCost->description }}</p>
                            </div>
                            <span class="text-sm font-medium">
                                Rp {{ number_format($order->shipping_price,0,',','.') }}
                            </span>
                        </div>
                    </div>

                    <!-- Detail Produk -->
                    <div class="bg-white p-6 md:p-8 border border-gray-200 mb-6 rounded-xl">
                        <h2 class="text-lg font-medium mb-6">Detail Produk</h2>

                        <div class="space-y-4">
                            @foreach($orderItems as $item)
                            <div class="flex gap-4 pb-4 border-b border-gray-200 last:border-b-0 last:pb-0">
                                <div class="w-20 h-20 bg-gray-100 flex-shrink-0">
                                    <img src="{{ $item->product->main_image ? Storage::url($item->product->main_image) : 'https://via.placeholder.com/150' }}"
                                        class="w-full h-full object-cover rounded-xl">
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-sm font-medium mb-1">{{ $item->name }}</h3>
                                    <p class="text-xs text-gray-500 mb-2">
                                        Ukuran: {{ $item->size }} · Warna: {{ $item->color }} · Jumlah: {{ $item->qty }}
                                    </p>
                                    <p class="text-sm font-medium">Rp {{ number_format($item->price,0,',','.') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium">Rp {{ number_format($item->subtotal,0,',','.') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-gray-50 border border-gray-200 p-4 mb-6 rounded-xl">
                        <p class="text-center text-xs text-gray-600">
                            <span class="font-medium">Status Pembayaran :</span>

                            @if($order->payment_status === 'paid')
                            <span class="text-green-600 font-medium">Terbayar</span>
                            @elseif($order->payment_status === 'pending')
                            <span class="text-yellow-600 font-medium">Menunggu Pembayaran</span>
                            @else
                            <span class="text-red-600 font-medium">Belum Dibayar</span>
                            @endif
                        </p>
                    </div>



                </div>

                <!-- Right Column - Order Summary -->
                <div class="lg:col-span-5">
                    <div class="bg-white p-6 md:p-8 border border-gray-200 sticky top-24 rounded-xl">
                        <h2 class="text-lg font-medium mb-6">Ringkasan Pesanan</h2>

                        <!-- Products -->
                        <div class="space-y-4 mb-6 pb-6 border-b border-gray-200">
                            @foreach($orderItems as $item)
                            <div class="flex gap-4">
                                <div class="w-20 h-20 bg-gray-100 flex-shrink-0">
                                    <img src="{{ $item->product->main_image ? Storage::url($item->product->main_image) : 'https://via.placeholder.com/150' }}"
                                        class="w-full h-full object-cover rounded-xl">
                                </div>

                                <div class="flex-1">
                                    <h3 class="text-sm font-medium mb-1">{{ $item->name }}</h3>
                                    <p class="text-xs text-gray-500 mb-2">
                                        Uk: {{ $item->size }} · Warna: {{ $item->color }} · Jumlah: {{ $item->qty }}
                                    </p>
                                    <p class="text-sm font-medium">
                                        Rp {{ number_format($item->price,0,',','.') }}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Perhitungan Harga -->
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium">
                                    Rp {{ number_format($order->subtotal,0,',','.') }}
                                </span>
                            </div>

                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Ongkos Kirim</span>
                                <span class="font-medium">
                                    Rp {{ number_format($order->shipping_price,0,',','.') }}
                                </span>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-200 mb-6">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-lg font-medium">Total</span>
                                <span class="text-2xl font-medium">
                                    Rp {{ number_format($order->total,0,',','.') }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-500">Sudah termasuk PPN</p>
                        </div>

                        <!-- Info Box -->
                        <!-- Tombol Bayar -->
                        @if($order->payment_status === 'paid')
                        <div class="w-full bg-green-600 text-white py-3 text-sm rounded-xl text-center mb-4">
                            ✔ Pembayaran Berhasil
                        </div>
                        @else
                        <!-- id nya sesuai script di bawah "pay-button" -->
                        <button id="pay-button" 
                            class="w-full bg-gray-900 text-white py-3 text-sm rounded-xl hover:bg-gray-800 transition mb-4">
                            Bayar Sekarang
                        </button>
                        @endif

                        <!-- Tempat nampung response Midtrans (opsional) -->
                        <pre id="result-json" class="mt-4 p-3 bg-gray-100 text-sm rounded hidden"></pre>


                        <a href="/" class="block w-full border border-gray-200 py-3 text-sm text-center hover:border-gray-400 transition rounded-xl">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>

<!-- Midtrans Snap.js -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function() {
        // SnapToken acquired from previous step
        snap.pay('{{ $order->snap_token }}', {
            // Optional
            onSuccess: function(result) {
                window.location.href = "{{ route('payment.success', ['order_id' => $order->id]) }}";
            },
            // Optional
            onPending: function(result) {
                /* You may add your own js here, this is just example */
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onError: function(result) {
                /* You may add your own js here, this is just example */
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            }
        });
    };
</script>


</html>