<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoriesController extends Controller
{
    

     public function show($slug)
    {
        return redirect()->route('products.byCategory', ['slug' => $slug]);
    }
}