<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all(); // Ambil data kategori
        $products = Product::with('category')->latest()->take(8)->get();
        
        return view('homepage.layouts.app', compact('products', 'categories')); // Kirim ke view utama
    }
} 