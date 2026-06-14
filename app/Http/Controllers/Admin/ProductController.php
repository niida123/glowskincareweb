<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::select('id','name')->orderBy('name')->get();
        return view('admin.layouts.products.index', compact('categories'));
    }

    public function list(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $products = Product::with('category')
            ->orderByDesc('id')
            ->paginate($perPage, ['id','code','name','description','price','discount','stock','image','category_id']);
        return response()->json($products);
    }

    public function create()
    {
        $categories = Category::select('id','name')->orderBy('name')->get();
        return view('admin.layouts.products.index', compact('categories'));
    }

    public function categories()
    {
        $categories = Category::select('id','name')->orderBy('name')->get();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'code' => 'nullable|string|max:255|unique:products,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // Ensure code and slug exist even if the UI did not supply them.
        if (empty($data['code'])) {
            $data['code'] = 'PRD-' . Str::upper(Str::random(8));
        }

        $baseSlug = $data['slug'] ?? Str::slug($data['name']);
        $slug = $baseSlug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        $data['slug'] = $slug;

        // Normalize discount when omitted.
        $data['discount'] = $data['discount'] ?? 0;

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }

        $product = Product::create($data);
        $product->load('category');
        return response()->json($product, 201);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'slug' => 'nullable|string|max:255|unique:products,slug,'.$product->id,
            'code' => 'required|string|max:255|unique:products,code,'.$product->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'category_id' => 'nullable|exists:categories,id',
        ]);
        // Auto-fill slug if missing and ensure uniqueness when renaming
        $baseSlug = $data['slug'] ?? Str::slug($data['name']);
        $slug = $baseSlug;
        $counter = 1;
        while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        $data['slug'] = $slug;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }

        $product->update($data);
        $product->load('category');
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
