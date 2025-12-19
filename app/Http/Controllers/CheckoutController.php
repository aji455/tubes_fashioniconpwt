<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingCost;
use App\Models\Cart;
use App\Models\OrderItem;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    // =====================================================
    // HALAMAN CHECKOUT
    // =====================================================
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login dulu.');
        }

        $cart = Cart::with('product')->where('user_id', auth()->id())->get();

        if ($cart->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang masih kosong!');
        }

        $subtotal = $cart->sum(fn($item) => $item->quantity * $item->product->price);
        $total_qty = $cart->sum('quantity');
        $shippingCosts = ShippingCost::all();

        return view('checkout.index', compact(
            'cart',
            'subtotal',
            'total_qty',
            'shippingCosts'
        ));
    }

    // =====================================================
    // PROSES CHECKOUT + MIDTRANS
    // =====================================================
    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email',
            'phone'      => 'required',
            'address'    => 'required',
            'city'       => 'required',
            'province'   => 'required',
            'postal_code' => 'required',
            'shipping_id' => 'required|exists:shipping_costs,id',
        ]);

        // Ambil cart
        $cart = Cart::with('product')->where('user_id', auth()->id())->get();

        if ($cart->isEmpty()) {
            return back()->with('error', 'Keranjang kosong.');
        }

        $cartClone = $cart->map(fn($item) => $item);
        $shipping = ShippingCost::findOrFail($request->shipping_id);

        $subtotal = $cart->sum(fn($item) => $item->product->price * $item->quantity);
        $total = $subtotal + $shipping->price;

        // =====================
        // Buat Order
        // =====================
        $order = Order::create([
            'user_id'          => auth()->id(),
            'full_name'        => $request->first_name . ' ' . $request->last_name,
            'email'            => $request->email,
            'phone'            => $request->phone,
            'address'          => $request->address,
            'city'             => $request->city,
            'province'         => $request->province,
            'postal_code'      => $request->postal_code,
            'notes'            => $request->notes,
            'shipping_costs_id' => $shipping->id,
            'subtotal'         => $subtotal,
            'shipping_price'   => $shipping->price,
            'total'            => $total,
            'shipping_status'  => 'pending',
            'status'           => 'pending',
        ]);

        // Simpan item order
        foreach ($cartClone as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'name'       => $item->product->name,
                'size'       => $item->size,
                'color'      => $item->color,
                'qty'        => $item->quantity,
                'price'      => $item->product->price,
                'subtotal'   => $item->product->price * $item->quantity,
            ]);
        }

        // Hapus cart
        Cart::where('user_id', auth()->id())->delete();

        // =====================
        // SETTING MIDTRANS
        // =====================
        Config::$serverKey    = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        // =====================
        // PARAM MIDTRANS
        // =====================
        $midtransOrderId = "ORDER-{$order->id}-" . time();

        $transactionData = [
            'transaction_details' => [
                'order_id'     => $midtransOrderId,
                'gross_amount' => (int) $order->total,
            ],
            'customer_details' => [
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'phone'      => $request->phone,
            ],
            'item_details' => [],
            'callbacks' => [
                'finish' => route('payment.success', ['order_id' => $order->id]),
            ]
        ];

        // Tambah produk ke Midtrans
        foreach ($cartClone as $item) {
            $transactionData['item_details'][] = [
                'id'       => $item->product_id,
                'price'    => (int) $item->product->price,
                'quantity' => (int) $item->quantity,
                'name'     => $item->product->name,
            ];
        }

        // Tambah ongkir
        $transactionData['item_details'][] = [
            'id'       => 'shipping-cost',
            'price'    => (int) $shipping->price,
            'quantity' => 1,
            'name'     => 'Ongkos Kirim',
        ];

        // =====================
        // Generate Snap Token
        // =====================
        try {
            $snapToken = Snap::getSnapToken($transactionData);

            //dd($snapToken);
            $order->update([
                'snap_token'   => $snapToken,
                'payment_status' => 'pending'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('checkout.index')
                ->with('error', 'Midtrans Error: ' . $e->getMessage());
        }

        return redirect()->route('checkout.confirm', $order->id);
    }

    // =====================================================
    // HALAMAN KONFIRMASI
    // =====================================================
    public function confirm($orderId)
    {
        $order = Order::findOrFail($orderId);
        $shipping = ShippingCost::find($order->shipping_costs_id);

        $orderItems = OrderItem::with('product')
            ->where('order_id', $orderId)
            ->get();

        return view('checkout.confirm', compact(
            'order',
            'shipping',
            'orderItems'
        ));
    }

    // =====================================================
    // NOTIFICATION MIDTRANS (SERVER → SERVER)
    // =====================================================
    public function notification(Request $request)
    {
        $notif = new \Midtrans\Notification();

        $midtransOrderId = $notif->order_id;
        $status = $notif->transaction_status;

        // Ambil order_id asli dari format ORDER-{id}-{timestamp}
        $parts = explode('-', $midtransOrderId);
        $orderId = $parts[1] ?? null;

        if (!$orderId) return;

        $order = Order::where('id', $orderId)->first();

        if (!$order) return;

        if ($status === 'capture' || $status === 'settlement') {
            $order->payment_status = 'paid';
        } elseif ($status === 'pending') {
            $order->payment_status = 'pending';
        } elseif ($status === 'deny') {
            $order->payment_status = 'deny';
        } elseif ($status === 'expire') {
            $order->payment_status = 'expire';
        } elseif ($status === 'cancel') {
            $order->payment_status = 'cancel';
        }

        $order->save();
    }

    // =====================================================
    // HALAMAN SUCCESS
    // =====================================================
    public function success($order_id)
    {
        $order = Order::with(['items.product'])
            ->where('id', $order_id)
            ->firstOrFail();

        // Update status pembayaran & status order di db
        

        // Kurangi stock produk
        foreach ($order->items as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $product->decrement('stock', $item->qty);
            }
        }

        return view('checkout.success', compact('order'));
    }

    public function callback(Request $request)
    {
        \Log::info('MIDTRANS CALLBACK', $request->all());

        $serverKey = env('MIDTRANS_SERVER_KEY'); 

        $expected = hash(
            'sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($expected !== $request->signature_key) {
            \Log::error('INVALID SIGNATURE');
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Extract order id (ORDER-{id}-{timestamp})
        $parts = explode('-', $request->order_id);
        $orderId = $parts[1] ?? null;

        if (!$orderId) {
            \Log::error('ORDER ID PARSE FAIL');
            return response()->json(['message' => 'Order parse failed'], 422);
        }

        $order = Order::find($orderId);

        if (!$order) {
            \Log::error('ORDER NOT FOUND');
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Update status
        if (in_array($request->transaction_status, ['capture', 'settlement'])) {
            $order->update([
                'payment_status'  => 'paid',
                'shipping_status' => 'packed',
                'status'          => 'process',
            ]);
        }

        if (in_array($request->transaction_status, ['deny', 'cancel', 'expire'])) {
            $order->update([
                'payment_status'  => 'failed',
                'shipping_status' => 'pending',
                'status'          => 'pending',
            ]);
        }

        return response()->json(['message' => 'OK'], 200);
    }

}
