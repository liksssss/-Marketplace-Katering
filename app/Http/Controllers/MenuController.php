<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class MenuController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'merchant') {
            // Jika yang login Merchant, tampilkan menu miliknya sendiri
            $menus = Menu::where('merchant_id', Auth::id())->get();
        } else {
            // Jika yang login Customer, tampilkan semua menu dari semua merchant
            $menus = Menu::all();
        }
    
        return view('menu.index', compact('menus'));
    }
    
    public function create()
    {
        return view('menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu_images', 'public');
        }

        Menu::create([
            'merchant_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $menu = Menu::where('merchant_id', Auth::id())->findOrFail($id);
        return view('menu.edit', compact('menu'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $menu = Menu::where('merchant_id', Auth::id())->findOrFail($id);


        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu_images', 'public');
            $menu->image = $imagePath;
        }

        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $menu = Menu::where('merchant_id', Auth::id())->findOrFail($id);


        if ($menu->image && Storage::disk('public')->exists($menu->image)) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus!');
    }

    public function show($id)
    {
        $menu = Menu::with('merchant')->findOrFail($id);
        return view('menu.show', compact('menu'));
    }
}
