<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        // Validate
        $fields = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'avatar' => ['file', 'nullable', 'max:5000']
        ]);

        if ($request->hasFile('avatar')) {
            $fields['avatar'] = Storage::disk('public')->put('avatars', $request->avatar);
        }

        // Register
        $user = User::create($fields);

        // Login
        Auth::login($user);

        return redirect()->route('dashboard')->with('greet', 'Welcome to Laravel.');
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($fields, request()->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard')->with('greet', 'Nice to meet you!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
