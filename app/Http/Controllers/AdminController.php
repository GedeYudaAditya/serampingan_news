<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'bg' => 'withBg',
            'active' => 'dashboard',
            'nav' => false,
            'title' => 'Admin Serampingan News',
            'contex' => 'Dashboard',
            'count' => Berita::all()->count(),
            'last_update' => Berita::latest()->first()->created_at->diffForHumans()
        ];

        return view('admin.index', $data);
    }

    public function berita()
    {
        $data = [
            'bg' => 'withBg',
            'active' => 'berita',
            'nav' => false,
            'title' => 'Admin Serampingan News',
            'contex' => 'Berita',
            'allNews' => Berita::latest()->filter(request(['search', 'category', 'author']))->paginate(10)->withQueryString()
            // 'allNews' => Berita::latest()->paginate(10)->withQueryString()
        ];

        return view('admin.berita', $data);
    }

    public function login()
    {
        $data = [
            'bg' => 'noBg',
            'active' => 'login',
            'nav' => false,
            'title' => 'Admin Serampingan News',
            'contex' => 'Login'
        ];

        return view('admin.login', $data);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
