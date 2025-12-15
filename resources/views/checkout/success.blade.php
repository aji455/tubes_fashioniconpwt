<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pembayaran Berhasil — Fashion Icon Purwokerto</title>
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

        @keyframes checkmark {
            0% {
                stroke-dashoffset: 100;
            }

            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .checkmark-circle {
            animation: scaleIn 0.5s ease-out;
        }

        .checkmark-path {
            stroke-dasharray: 100;
            stroke-dashoffset: 100;
            animation: checkmark 0.5s ease-out 0.3s forwards;
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
                        <div class="w-6 h-6 rounded-full bg-gray-900 text-white flex items-center justify-center text-xs">✓</div>
                        <span class="text-gray-400">Konfirmasi pesanan</span>
                    </div>
                    <div class="w-8 h-px bg-gray-900"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full bg-gray-900 text-white flex items-center justify-center text-xs">✓</div>
                        <span class="text-gray-900">Pembayaran</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-8 md:py-12">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">

            <!-- Success Message -->
            <div class="mb-8">
                <div class="bg-white border border-gray-200 p-8 md:p-12 text-center rounded-xl">
                    <div class="mb-6">
                        <svg class="w-20 h-20 mx-auto checkmark-circle" viewBox="0 0 52 52">
                            <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" stroke="#111827" stroke-width="2" />
                            <path class="checkmark-path" fill="none" stroke="#111827" stroke-width="3" stroke-linecap="round" d="M14 27l7 7 16-16" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-medium mb-2">Pembayaran Berhasil!</h1>
                    <p class="text-gray-600 text-sm mb-4">Terima kasih telah melakukan pembayaran</p>
                    <p class="text-xs text-gray-500">Berikut detail pesanan Anda</p>
                </div>
            </div>

            <!-- Detail Pesanan -->
            <div class="bg-white p-6 md:p-8 border border-gray-200 mb-6 rounded-xl">
                <h2 class="text-lg font-medium mb-6">Detail Pesanan</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">ID Pesanan</p>
                        <p class="font-medium">{{ $order->id }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 mb-1">Status Pembayaran</p>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <p class="font-medium text-green-600">Berhasil</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 mb-1">Nama Pemesan</p>
                        <p>{{ $order->full_name }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 mb-1">No. Telepon</p>
                        <p>{{ $order->phone }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-xs text-gray-500 mb-1">Alamat Pengiriman</p>
                        <p>{{ $order->address }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 mb-1">Kurir</p>
                        <p>{{ $order->shippingCost->name }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 mb-1">Ongkir</p>
                        <p>Rp {{ number_format($order->shipping_price,0,',','.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Detail Produk -->
            <div class="bg-white p-6 md:p-8 border border-gray-200 mb-6 rounded-xl">
                <h2 class="text-lg font-medium mb-6">Produk yang Dipesan</h2>

                <div class="space-y-4">
                    @foreach($order->items as $item)
                    <div class="flex justify-between pb-4 border-b border-gray-200 last:border-b-0 last:pb-0">
                        <div class="flex-1">
                            <p class="text-sm font-medium mb-1">{{ $item->name }}</p>
                            <p class="text-xs text-gray-500">Jumlah: {{ $item->qty }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Total Pembayaran -->
            <div class="bg-white p-6 md:p-8 border border-gray-200 mb-6 rounded-xl">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-medium">Total Pembayaran</span>
                    <span class="text-2xl font-medium">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
                <p class="text-xs text-gray-500 mt-2">Sudah termasuk ongkos kirim dan PPN</p>
            </div>

            <!-- Success Info Box -->
            <div class="bg-green-50 border border-green-200 p-6 mb-6 rounded-xl">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-green-900 mb-1">Pembayaran Berhasil Dikonfirmasi</p>
                        <p class="text-xs text-green-800">Pesanan Anda akan segera diproses dan dikirim sesuai estimasi pengiriman. Konfirmasi pesanan telah dikirim ke email Anda.</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <a href="/" class="block w-full bg-gray-900 text-white py-4 text-sm font-medium text-center hover:bg-gray-800 transition rounded-xl">
                    Kembali ke Beranda
                </a>

                <a href="/profile" class="block w-full border border-gray-200 py-4 text-sm text-center hover:border-gray-400 transition rounded-xl">
                    Lihat Pesanan Saya
                </a>
            </div>

        </div>
    </main>

    <!-- Footer Info -->
    <div class="max-w-4xl mx-auto px-6 lg:px-8 pb-12 ">
        <div class="bg-white border border-gray-200 p-6 text-center rounded-xl">
            <p class="text-sm text-gray-600 mb-3">Butuh bantuan dengan pesanan Anda?</p>
            <div class="flex items-center justify-center gap-6 text-sm">
                <span class="text-gray-400"></span>
                <a href="https://wa.me/6285959628181" class="text-gray-900 font-medium hover:underline">WhatsApp Support</a>
            </div>
        </div>
    </div>

</body>

</html>