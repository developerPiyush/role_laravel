<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shops = Shop::paginate(10);
        return view('admin.shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|unique:shops|email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $image_name);
        } else {
            $image_name = null;
        }

        Shop::create([
            'shop_name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'image' => $image_name,
        ]);

        return redirect()->route('shops.index')->with('success', 'Shop created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        return view('admin.shops.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        return view('admin.shops.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shop $shop)
    {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'email' => 'required|max:255|unique:shops,email,' . $shop->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $shop->name = $request->name;
        $shop->address = $request->address;
        $shop->email = $request->email;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $shop->image = $imageName;
        }

        $shop->save();

        return redirect()->route('shops.index')
            ->with('success', 'Shop updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        if ($shop->image) {
            Storage::delete('public/images/' . $shop->image);
        }

        $shop->delete();
        return redirect()->route('shops.index')
            ->with('success', 'Shop deleted successfully');
    }


}
