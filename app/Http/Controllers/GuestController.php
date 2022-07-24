<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Category;
use App\Models\PorfilDesa;
use App\Models\User;
use App\Models\WebImgManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function index()
    {
        if (WebImgManagement::count() > 0) {
            $image = WebImgManagement::first();
        } else {
            $image = false;
        }

        $data = [
            'bg' => 'withBg',
            'active' => 'none',
            'nav' => false,
            'title' => 'Serampingan News',
            'img' => $image
        ];

        return view('guest.index', $data);
    }

    public function beranda()
    {
        // data dummy
        $title = 'Beranda';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = 'Search in ' . $category->name;
        }

        if (request('author')) {
            $user = User::firstWhere('username', request('author'));
            $title = 'Search by ' . $user->name;
        }

        if (WebImgManagement::count() > 0) {
            $image = WebImgManagement::first();
        } else {
            $image = false;
        }

        $data = [
            'bg' => 'noBg',
            'active' => 'beranda',
            'nav' => true,
            'title' => $title . ' | Serampingan News',
            'allNews' => Berita::latest()->filter(request(['search', 'category', 'author']))->paginate(4)->withQueryString(),
            'img' => false,
            'img_splash' => $image
            // 'allNews' => Berita::latest()->paginate(4)->withQueryString()
        ];

        return view('guest.beranda', $data);
    }

    public function porfil()
    {
        $database = PorfilDesa::where('is_active', true)->get();

        if ($database->count() == 0) {
            $database = false;
        }

        $data = [
            'bg' => 'noBg',
            'active' => 'porfil',
            'nav' => true,
            'title' => 'Porfil | Serampingan News',
            'news' => $database,
            'rekomendasi' => Berita::latest()->paginate(4),
            'img' => false
        ];

        return view('guest.porfil', $data);
    }

    public function strukturDesa()
    {
        $database = PorfilDesa::where('is_active', true)->get();

        if ($database->count() == 0) {
            $database = false;
        }

        $data = [
            'bg' => 'noBg',
            'active' => 'struktur',
            'nav' => true,
            'title' => 'Struktur Desa | Serampingan News',
            'news' => $database,
            'rekomendasi' => Berita::latest()->paginate(4),
            'img' => false
        ];

        return view('guest.strukturDesa', $data);
    }

    public function post(Berita $berita)
    {


        $data = [
            'bg' => 'noBg',
            'active' => 'none',
            'nav' => true,
            'title' => $berita->title . " | Serampingan News",
            'news' => $berita,
            'rekomendasi' => Berita::latest()->where('category_id', $berita->category->id)->paginate(5),
            'img' => false
        ];

        // dd($data);

        return view('guest.news', $data);
    }
}
