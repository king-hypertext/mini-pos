<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductSize;
use App\Models\ProductStatus;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $brands = Brand::all();
        $categories = Category::all();
        return view('products.index', array('page_title' => env('APP_NAME') . ' | ALL PRODUCTS', 'products' => $products, 'brands' => $brands, 'categories' => $categories));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('products.create', array('page_title' => env('APP_NAME') . ' | ADD PRODUCT', 'brands' => $brands, 'categories' => $categories));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // $request->dd();
        $request->validated();
        $s = ['In Stock', 'Out of Stock', 'Low Stock', 'Pending Restock'];
        for ($i = 0; $i < count($s); $i++) {
            ProductStatus::create([
                'status' => $s[$i],
            ]);
        }
        $brand = Brand::firstOrCreate(['id' => (int)$request->brand], ['name' => $request->brand ?? 'N/A']);
        $category = Category::firstOrCreate(['id' => (int)$request->category], ['name' => $request->category ?? 'N/A']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_dir = $image->store('images/products', 'public');
        }
        Product::create([
            'name' => $request->name,
            'description' => $request->description ?? null,
            'market_price' => $request->market_price,
            'price' => $request->price,
            'expiry_date' => $request->expiry_date,
            'image' => $request->hasFile('image') ? '/storage/' . $image_dir : null,
            'quantity' => 0,
            'product_status_id' => 4,
            'brand_id' => $brand->id,
            'category_id' => $category->id,
        ]);
        return redirect()->route('products.index')->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', array('product' => $product, 'page_title' => env('APP_NAME') . ' | ' . strtoupper($product->name)));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $page_title = env('APP_NAME') . '| EDIT ' . strtoupper($product->name);
        return view('products.edit', compact('product', 'categories', 'page_title', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $request->validated();

        $brand = Brand::firstOrCreate(['id' => (int)$request->brand], ['name' => $request->brand ?? 'N/A']);
        $category = Category::firstOrCreate(['id' => (int)$request->category], ['name' => $request->category ?? 'N/A']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_dir = $image->store('images/products', 'public');
            $product->image = '/storage/' . $image_dir;
            $product->update();
        }
        $product->update([
            'name' => $request->name,
            'description' => $request->description ?? null,
            'market_price' => $request->market_price,
            'price' => $request->price,
            'expiry_date' => $request->expiry_date,
            'quantity' => 5,
            'product_status_id' => 4,
            'brand_id' => $brand->id,
            'category_id' => $category->id,
        ]);
        return redirect()->route('products.edit', $product->id)->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
    public function productExists(Request $request, Product $product)
    {
        $name = $request->name;
        if (!$name) {
            return false;
        }
        $data = $product->firstWhere('name', $name);
        // dd($data);
        if (!$data) {
            return false;
        }
        return true;
    }
}
