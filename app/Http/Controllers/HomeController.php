<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::active()->featured()->inStock()->take(8)->get();
        $categories = Category::active()->orderBy('sort_order')->get();
        $latestProducts = Product::active()->inStock()->latest()->take(8)->get();
        
        return view('home', compact('featuredProducts', 'categories', 'latestProducts'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->active()->firstOrFail();
        $products = Product::where('category_id', $category->id)
            ->active()
            ->inStock()
            ->paginate(12);
        
        return view('category', compact('category', 'products'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $products = Product::active()
            ->inStock()
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('brand', 'like', "%{$query}%")
                  ->orWhere('model', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->paginate(12);
        
        return view('search', compact('products', 'query'));
    }
}
