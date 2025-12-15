@extends('auth.auth')

@section('content')
<div>
    <div class="mb-8">
        <h2 class="text-3xl font-light tracking-tight text-gray-900 mb-2">
            Buat Akun Baru
        </h2>
        <p class="text-gray-600 font-light">
            Bergabunglah dengan Fashion Icon Purwokerto
        </p>
    </div>

    <form action="{{ route('register') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-900 mb-2">
                Nama Lengkap
            </label>
            <input type="text"
                   id="name"
                   name="name"
                   required
                   value="{{ old('name') }}"
                   class="input-field w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-gray-900"
                   placeholder="Pelanggan Setia" />
            @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-900 mb-2">
                Email
            </label>
            <input type="email"
                   id="email"
                   name="email"
                   required
                   value="{{ old('email') }}"
                   class="input-field w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-gray-900"
                   placeholder="pelanggan@email.com" />
            @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-900 mb-2">
                Nomor Telepon
            </label>
            <input type="tel"
                   id="phone"
                   name="phone"
                   required
                   value="{{ old('phone') }}"
                   class="input-field w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-gray-900"
                   placeholder="0858XXXXXXXX" />
            @error('phone')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-900 mb-2">
                Password
            </label>
            <input type="password"
                   id="password"
                   name="password"
                   required
                   class="input-field w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-gray-900"
                   placeholder="••••••••" />
            @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter</p>
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-900 mb-2">
                Konfirmasi Password
            </label>
            <input type="password"
                   id="password_confirmation"
                   name="password_confirmation"
                   required
                   class="input-field w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-gray-900"
                   placeholder="••••••••" />
        </div>

        <div class="flex items-start">
            <input type="checkbox"
                   name="terms"
                   id="terms"
                   required
                   class="w-4 h-4 mt-1 border-gray-300 rounded text-gray-900 focus:ring-gray-900" />
            <label for="terms" class="ml-2 text-sm text-gray-600">
                Saya setuju dengan
                <a href="#" class="text-gray-900 hover:text-gray-600 transition-colors">Syarat & Ketentuan</a>
                dan
                <a href="#" class="text-gray-900 hover:text-gray-600 transition-colors">Kebijakan Privasi</a>
            </label>
        </div>

        <button type="submit"
                class="w-full bg-gray-900 text-white py-3 rounded-lg font-medium hover:bg-gray-800 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
            Daftar
        </button>
    </form>

    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-4 bg-gray-50 text-gray-500">atau</span>
        </div>
    </div>

    <p class="mt-6 text-center text-sm text-gray-600">
        Sudah punya akun?
        <a href="{{ route('login') }}"
           class="font-medium text-gray-900 hover:text-gray-600 transition-colors">
            Masuk di sini
        </a>
    </p>
</div>
@endsection
