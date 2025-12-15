@extends('auth.auth')

@section('content')
<div>
    <div class="mb-8">
        <h2 class="text-3xl font-light tracking-tight text-gray-900 mb-2">
            Selamat Datang
        </h2>
        <p class="text-gray-600 font-light">
            Masuk ke akun Anda untuk melanjutkan
        </p>
    </div>

    <form action="{{ route('login') }}" method="POST" class="space-y-6">
        @csrf

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
                   placeholder="nama@email.com" />
            @error('email')
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
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox"
                       name="remember"
                       class="w-4 h-4 border-gray-300 rounded text-gray-900 focus:ring-gray-900" />
                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
            </label>

        </div>

        <button type="submit"
                class="w-full bg-gray-900 text-white py-3 rounded-lg font-medium hover:bg-gray-800 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
            Masuk
        </button>
    </form>

    <div class="relative my-8">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-4 bg-gray-50 text-gray-500">atau</span>
        </div>
    </div>

    <p class="mt-8 text-center text-sm text-gray-600">
        Belum punya akun?
        <a href="{{ route('register') }}"
           class="font-medium text-gray-900 hover:text-gray-600 transition-colors">
            Daftar sekarang
        </a>
    </p>
</div>
@endsection
