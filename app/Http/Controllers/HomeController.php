<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Remove auth middleware to allow public access
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $featuredProducts = Product::with('category')->latest()->take(8)->get();
        
        // Get wishlist product IDs for logged-in user
        $wishlistIds = [];
        if (auth()->check()) {
            $wishlistIds = Wishlist::where('user_id', auth()->id())
                ->pluck('product_id')
                ->toArray();
        }
        
        return view('home', compact('categories', 'featuredProducts', 'wishlistIds'));
    }

    public function categories()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function products(Request $request)
    {
        $categories = Category::all();
        $categoryId = $request->query('category');
        $productsQuery = Product::with('category')->latest();
        $activeCategory = null;

        if ($categoryId) {
            $productsQuery->where('category_id', $categoryId);
            $activeCategory = $categories->firstWhere('id', (int) $categoryId);
        }

        $products = $productsQuery->paginate(12);

        // Get wishlist product IDs for logged-in user
        $wishlistIds = [];
        if (auth()->check()) {
            $wishlistIds = Wishlist::where('user_id', auth()->id())
                ->pluck('product_id')
                ->toArray();
        }

        return view('products.index', compact('products', 'categories', 'activeCategory', 'wishlistIds'));
    }

    public function showProduct($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $categories = Category::all();
        // Get related products from same category
        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->limit(4)
            ->get();
        return view('products.show', compact('product', 'categories', 'relatedProducts'));
    }
}
