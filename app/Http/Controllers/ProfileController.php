<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'address' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $user = Auth::user();
        $user->update($request->only('address', 'contact', 'description'));

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
