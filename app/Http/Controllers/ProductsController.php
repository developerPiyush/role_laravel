<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $shops = Shop::all();
        return view('admin.products.create', compact('shops'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'video' => 'required|mimetypes:video/mp4,video/quicktime',
            'shop_id' => 'required|exists:shops,id',
        ]);
        $existingProduct = Product::where('product_name', $request->name)->where('shop_id', $request->shop_id)->first();
        if ($existingProduct) {
            return redirect()->back()->withErrors(['name' => 'A product with this name already exists for this shop.'])->withInput();
        }

        $videoPath = $request->file('video')->store('videos', 'public');

        $product = new Product([
            'product_name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'video' => $videoPath,
            'shop_id' => $request->shop_id,
        ]);

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $shops = Shop::all();
        return view('admin.products.edit', compact('product', 'shops'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'shop_id' => 'required|exists:shops,id',
            'video' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:20000'
        ]);

        $product = Product::findOrFail($id);

        $product->product_name = $validatedData['product_name'];
        $product->price = $validatedData['price'];
        $product->stock = $validatedData['stock'];
        $product->shop_id = $validatedData['shop_id'];

        if ($request->hasFile('video')) {
            if ($product->video && Storage::exists($product->video)) {
                Storage::delete($product->video);
            }

            $videoPath = $request->file('video')->store('public/videos');
            $product->video = $videoPath;
        }

        $product->save();

        return redirect()->route('products.show', ['id' => $product->id])
            ->with('success', 'Product updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->video) {
            Storage::delete('public/videos/' . $product->video);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }


}
