@extends('homepage.index')
@section('content')
<!-- PROFILE HEADER -->
<section class="pt-24 pb-12 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-start md:items-center gap-6">

            <!-- Avatar -->
            @php
            $initial = strtoupper(substr($user->name, 0, 2));
            @endphp
            <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center text-2xl font-light text-gray-600">
                {{ $initial }}
            </div>

            <!-- User Info -->
            <div class="flex-1">
                <h1 class="text-2xl font-light tracking-tight mb-1">{{ $user->name }}</h1>
                <p class="text-sm text-gray-500">{{ $user->email }}</p>
            </div>

            <!-- Button Group -->
            <div class="flex gap-3">
                <a href="{{ route('profile.edit') }}"
                    class="text-sm text-gray-700 hover:text-gray-900 border border-gray-200 px-6 py-2 hover:border-gray-400 transition">
                    Edit Profil
                </a>


                <!-- LOGOUT BUTTON -->
                <button onclick="openLogoutModal()"
                    class="text-sm bg-red-500 text-white px-6 py-2 hover:bg-red-600 transition">
                    Logout
                </button>
            </div>

        </div>
    </div>
</section>


<!-- TABS -->
<section class="border-b border-gray-100 sticky top-16 bg-white z-40">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex gap-8">
            <button onclick="showTab('account')" id="tab-account"
                class="py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-900 transition">
                Informasi Akun
            </button>

            <button onclick="showTab('orders')" id="tab-orders"
                class="py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-900 transition">
                Histori Pembelian
            </button>
        </div>
    </div>
</section>

<!-- CONTENT -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <!-- ACCOUNT INFO -->
        <div id="content-account" class="tab-content">
            <div class="max-w-2xl">
                <h2 class="text-xl font-light mb-8">Informasi Pribadi</h2>

                <div class="space-y-6">

                    <!-- Nama -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Nama Lengkap</label>
                            <p class="text-sm text-gray-900 py-2 border-b border-gray-200">{{ $user->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Role</label>
                            <p class="text-sm text-gray-900 py-2 border-b border-gray-200">{{ $user->role }}</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Email</label>
                        <p class="text-sm text-gray-900 py-2 border-b border-gray-200">{{ $user->email }}</p>
                    </div>

                    <!-- Telepon -->
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Nomor Telepon</label>
                        <p class="text-sm text-gray-900 py-2 border-b border-gray-200">
                            {{ $user->phone ?? '-' }}
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <!-- ORDER HISTORY -->
        <div id="content-orders" class="tab-content hidden">
            <div class="space-y-6">

                @forelse($user->orders()->latest()->get() as $order)
                <div class="bg-white p-6 md:p-8 border border-gray-200 rounded-xl flex justify-between items-center">
                    <div class="flex-1">
                        <p class="text-sm text-gray-500">ID Pesanan: <span class="font-medium">#{{ $order->id }}</span></p>
                        <p class="text-sm text-gray-500">Tanggal: <span class="font-medium">{{ $order->created_at->format('d F Y') }}</span></p>
                        <p class="text-sm text-gray-500">Total: <span class="font-medium text-green-700">Rp {{ number_format($order->total) }}</span></p>
                        <p class="text-sm text-gray-500">Status Pembayaran:<span class="font-medium {{ $order->payment_status === 'paid' ? 'text-green-700' : ($order->payment_status === 'pending' ? 'text-yellow-600' : 'text-red-600') }}">{{ ucfirst($order->payment_status ?? 'unpaid') }}</span></p>
                        <p class="text-sm text-gray-500">Status Pengiriman: <span class="font-medium">{{ ucfirst($order->shipping_status) }}</span></p>
                        <p class="text-sm text-gray-500">Status Pesanan: <span class="font-medium">{{ ucfirst($order->status) }}</span></p>
                    </div>
                    <div>
                        <a href="{{ url('/checkout/confirm/' . $order->id) }}"
                            class="text-sm bg-gray-900 text-white px-4 py-2 rounded-md hover:bg-gray-800 transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-sm">Belum ada histori pembelian.</p>
                @endforelse

            </div>
        </div>


    </div>

    <!-- LOGOUT CONFIRMATION MODAL -->
    <div id="logoutModal"
        class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        <div class="bg-white w-80 rounded-lg shadow-lg p-6 text-center">

            <h2 class="text-lg font-medium mb-4">Yakin ingin keluar?</h2>
            <p class="text-sm text-gray-600 mb-6">Kamu akan logout dari akun ini.</p>

            <div class="flex gap-3">
                <button onclick="closeLogoutModal()"
                    class="flex-1 py-2 border border-gray-300 hover:bg-gray-100 transition text-sm">
                    Batal
                </button>

                <form action="{{ route('logout') }}" method="POST" class="flex-1">
                    @csrf
                    <button class="w-full py-2 bg-red-600 text-white hover:bg-red-700 transition text-sm">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </div>

</section>

<!-- SCRIPT TAB & LOGOUT MODAL -->
<script>
    // Fungsi TAB
    function showTab(tab) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.getElementById('content-' + tab).classList.remove('hidden');

        document.querySelectorAll('[id^="tab-"]').forEach(el => {
            el.classList.remove('border-gray-900');
            el.classList.add('text-gray-500');
        });

        document.getElementById('tab-' + tab).classList.add('border-gray-900');
        document.getElementById('tab-' + tab).classList.remove('text-gray-500');
    }

    // Fungsi Modal Logout — DIPISAH dari showTab!
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.remove('hidden');
    }

    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.add('hidden');
    }
</script>

@endsection