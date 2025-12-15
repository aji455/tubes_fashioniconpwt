<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Tampilkan halaman register
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses register user baru
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        Auth::login($user);

        // Merge cart session ke user baru
        $this->moveSessionCartToDatabase();

        return redirect()->intended('/');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors(['email' => 'Email atau password salah']);
        }

        // Prevent session fixation
        $request->session()->regenerate();

        // Merge cart session ke user login
        $this->moveSessionCartToDatabase();

        return redirect()->intended('/');
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Memindahkan cart dari session ke database user login
     */
    private function moveSessionCartToDatabase()
    {
        if (!session()->has('cart')) {
            return;
        }

        $sessionCart = session('cart');
        if (!is_array($sessionCart) || empty($sessionCart)) {
            return;
        }

        $user = Auth::user();

        foreach ($sessionCart as $rowId => $item) {
            if (!is_array($item) || !isset($item['quantity']) || !isset($item['product_id'])) {
                continue;
            }

            $productId = intval($item['product_id']); // Pastikan product_id integer
            $quantity  = max(1, (int) $item['quantity']);
            $size      = $item['size'] ?? 'nosize';
            $color     = $item['color'] ?? 'nocolor';

            // Cek apakah user sudah punya cart ini (product + size + color unik)
            $existing = Cart::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->where('size', $size)
                ->where('color', $color)
                ->first();

            if ($existing) {
                $existing->quantity += $quantity;
                $existing->save();
            } else {
                Cart::create([
                    'user_id'    => $user->id,
                    'product_id' => $productId,
                    'quantity'   => $quantity,
                    'size'       => $size,
                    'color'      => $color,
                ]);
            }
        }

        // Hapus session cart setelah migrasi
        session()->forget('cart');
    }
}
