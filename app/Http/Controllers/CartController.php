<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Tambah produk ke cart
     */
    public function addToCart(Request $request, $id)
    {
        //dd($request->all());

        $product = Product::with('category')->findOrFail($id);

        $qty   = max(1, (int) $request->quantity);
        $size  = $request->size ?? 'nosize';
        $color = $request->color ?? 'nocolor';

        // ==========================
        // GUEST CART (SESSION)
        // ==========================
        if (!Auth::check()) {

            $cart = session()->get('cart', []);

            $rowId = $id . '-' . $size . '-' . $color;

            if (isset($cart[$rowId])) {
                $cart[$rowId]['quantity'] += $qty;
            } else {
                $cart[$rowId] = [
                    'row_id'     => $rowId,
                    'product_id' => $id,
                    'name'       => $product->name,
                    'price'      => $product->price,
                    'image'      => $product->main_image,
                    'category'   => $product->category->name ?? '-',
                    'quantity'   => $qty,
                    'size'       => $size,
                    'color'      => $color,
                ];
            }

            session()->put('cart', $cart);

            return back()->with('success', 'Produk ditambahkan ke keranjang!');
        }

        // ==========================
        // USER LOGIN (DATABASE)
        // ==========================
        $cart = Cart::firstOrNew([
            'user_id'    => Auth::id(),
            'product_id' => $product->id,
            'size'       => $size,
            'color'      => $color,
        ]);

        $cart->quantity = ($cart->exists ? $cart->quantity : 0) + $qty;
        $cart->save();

        return back()->with('success', 'Produk ditambahkan ke keranjang!');
    }


    /**
     * Tampilkan halaman cart
     */
    public function index()
    {
        // USER LOGIN
        if (Auth::check()) {
            $items = Cart::with('product.category')
                ->where('user_id', Auth::id())
                ->get()
                ->map(function ($cart) {
                    return (object)[
                        'row_id'  => $cart->id, // <= ID CART DB
                        'id'      => $cart->id,
                        'quantity'=> $cart->quantity,
                        'size'    => $cart->size,
                        'color'   => $cart->color,
                        'product' => $cart->product,
                    ];
                });
        }

        // GUEST
        else {
            $sessionCart = session()->get('cart', []);

            $items = collect($sessionCart)->map(function ($item) {
                return (object)[
                    'row_id'  => $item['row_id'], // <= STRING ROW ID
                    'id'      => $item['row_id'],
                    'quantity'=> $item['quantity'],
                    'size'    => $item['size'],
                    'color'   => $item['color'],
                    'product' => (object)[
                        'id'        => $item['product_id'],
                        'name'      => $item['name'],
                        'price'     => $item['price'],
                        'main_image'=> $item['image'],
                        'category'  => (object)[
                            'name' => $item['category']
                        ]
                    ]
                ];
            });
        }

        return view('cart.index', compact('items'));
    }


    /**
     * Update quantity
     */
    public function updateQuantity(Request $request, $rowId)
    {
        $quantity = max(1, (int) $request->quantity);

        // LOGIN
        if (Auth::check()) {
            $cart = Cart::find($rowId);
            if ($cart) {
                $cart->quantity = $quantity;
                $cart->save();
                return back()->with('success', 'Quantity diperbarui.');
            }
            return back()->with('error', 'Cart tidak ditemukan.');
        }

        // GUEST
        $cart = session()->get('cart', []);
        if (isset($cart[$rowId])) {
            $cart[$rowId]['quantity'] = $quantity;
            session()->put('cart', $cart);
            return back()->with('success', 'Quantity diperbarui.');
        }

        return back()->with('error', 'Cart tidak ditemukan.');
    }



    /**
     * Hapus produk
     */
    public function remove($rowId)
    {
        // LOGIN
        if (Auth::check()) {
            $cart = Cart::find($rowId);
            if ($cart) {
                $cart->delete();
                return back()->with('success', 'Produk dihapus.');
            }
            return back()->with('error', 'Cart tidak ditemukan.');
        }

        // GUEST
        $cart = session()->get('cart', []);
        if (isset($cart[$rowId])) {
            unset($cart[$rowId]);
            session()->put('cart', $cart);
            return back()->with('success', 'Produk dihapus.');
        }

        return back()->with('error', 'Cart tidak ditemukan.');
    }
}
