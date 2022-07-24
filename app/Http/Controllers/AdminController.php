<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\User;
use App\Models\WebImgManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{


    public function index()
    {
        // $image = WebImgManagement::first();

        if (WebImgManagement::count() > 0) {
            $image = WebImgManagement::first();
        } else {
            $image = false;
        }

        $data = [
            'bg' => 'withBg',
            'active' => 'dashboard',
            'nav' => false,
            'title' => 'Admin Serampingan News',
            'contex' => 'Dashboard',
            'count' => Berita::all()->count(),
            'last_update' => Berita::latest()->first()->created_at->diffForHumans(),
            'img' => $image
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

    public function keamanan()
    {
        $data = [
            'bg' => 'withBg',
            'active' => 'keamanan',
            'nav' => false,
            'title' => 'Admin Serampingan News',
            'contex' => 'Keamanan',
            'users' => User::latest()->paginate(10)->withQueryString()
            // 'allNews' => Berita::latest()->paginate(10)->withQueryString()
        ];

        return view('admin.keamanan', $data);
    }

    public function ubahKeamanan(Request $request)
    {
        $userprofile = Auth::user();

        $rules = [
            'name' => 'required|max:255',
            'password' => 'required|min:4',
        ];

        if ($request->username != $userprofile->username) {
            $rules['username'] = 'required|min:3|max:255|unique:users';
        }

        if ($request->email != $userprofile->email) {
            $rules['email'] = 'required|email:dns|max:255|unique:users';
        }

        $validatedData = $request->validate($rules);
        // $validatedData['password'] = Hash::make($validatedData['password']);
        if (Hash::check($validatedData['password'], $userprofile->password)) {
            $validatedData['password'] = Hash::make($validatedData['password']);
            $userprofile->update($validatedData);
            return redirect('/dashboard/keamanan')->with('success', 'Ubah keamanan successfull!');
        }
        // $userprofile->name = $validatedData['name'];
        // $userprofile->username = $validatedData['username'];
        // $userprofile->email = $validatedData['email'];
        // $userprofile->save();

        return redirect('/dashboard/keamanan')->with('failed', 'Konfirmasi password anda dengan benar terlebih dahulu!');
    }

    public function img(Request $request)
    {
        $request->validate([
            'start_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (WebImgManagement::count() > 0) {
            Storage::remove(WebImgManagement::first()->start_image);
            WebImgManagement::where('id', 1)->update([
                'start_image' => $request->file('start_image')->store('start-images'),
            ]);
        } else {
            WebImgManagement::create([
                'start_image' => $request->file('start_image')->store('start-images'),
            ]);
        }

        return redirect('/dashboard')->with('success', 'Ubah background successfull!');
    }

    public function splashImg(Request $request)
    {
        $request->validate([
            'splash_image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'splash_image2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'splash_image3' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (WebImgManagement::count() > 0) {
            if (WebImgManagement::first()->splash_image1 != null) {
                Storage::delete(WebImgManagement::first()->splash_image1);
                WebImgManagement::where('id', 1)->update([
                    'splash_image1' => $request->file('splash_image1')->store('splash-images'),
                ]);
            } else {
                WebImgManagement::where('id', 1)->update([
                    'splash_image1' => $request->file('splash_image1')->store('splash-images'),
                ]);
            }
            if (WebImgManagement::first()->splash_image2 != null) {
                Storage::delete(WebImgManagement::first()->splash_image2);
                WebImgManagement::where('id', 1)->update([
                    'splash_image2' => $request->file('splash_image2')->store('splash-images'),
                ]);
            } else {
                WebImgManagement::where('id', 1)->update([
                    'splash_image2' => $request->file('splash_image2')->store('splash-images'),
                ]);
            }
            if (WebImgManagement::first()->splash_image3 != null) {
                Storage::delete(WebImgManagement::first()->splash_image3);
                WebImgManagement::where('id', 1)->update([
                    'splash_image3' => $request->file('splash_image3')->store('splash-images'),
                ]);
            } else {
                WebImgManagement::where('id', 1)->update([
                    'splash_image3' => $request->file('splash_image3')->store('splash-images'),
                ]);
            }

            // WebImgManagement::where('id', 1)->update([
            //     'splash_image1' => $request->file('splash_image1')->store('splash-images'),
            //     'splash_image2' => $request->file('splash_image2')->store('splash-images'),
            //     'splash_image3' => $request->file('splash_image3')->store('splash-images'),
            // ]);
        } else {
            WebImgManagement::create([
                'splash_image1' => $request->file('splash_image1')->store('splash-images'),
                'splash_image2' => $request->file('splash_image2')->store('splash-images'),
                'splash_image3' => $request->file('splash_image3')->store('splash-images'),
            ]);
        }

        return redirect('/dashboard')->with('success', 'Ubah splash image successfull!');
    }
}
