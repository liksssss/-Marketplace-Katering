<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $menus = Menu::where('name', 'like', '%' . $query . '%')
                    ->with('merchant') // pastikan relasi ke merchant ada
                    ->get();

        return view('search.index', compact('menus', 'query'));
    }
}
