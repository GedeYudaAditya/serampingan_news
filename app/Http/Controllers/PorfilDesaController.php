<?php

namespace App\Http\Controllers;

use App\Models\PorfilDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PorfilDesaController extends Controller
{
    public function index()
    {
        $data = [
            'bg' => 'withBg',
            'active' => 'profil',
            'nav' => false,
            'title' => 'Admin Serampingan News',
            'contex' => 'Profil',
            'allNews' => PorfilDesa::latest()->paginate(10)->withQueryString()
        ];

        return view('admin.profil', $data);
    }

    public function storeView()
    {
        $data = [
            'bg' => 'withBg',
            'active' => 'profil',
            'nav' => false,
            'title' => 'Admin Serampingan News',
            'contex' => 'Tambah Profil Desa',
        ];

        return view('admin.profil.tambah', $data);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'user_id' => 'required',
            'title' => 'required|max:255',
            'is_active' => 'required',
            'struktur' => 'image|file|max:1024|required',
            'informasi' => 'required',
        ]);

        $validatedData['struktur'] = $request->file('struktur')->store('struktur-images');

        if (PorfilDesa::all()) {
            // PorfilDesa::where()->update([
            //     'is_active' => false
            // ]);
            DB::table('porfil_desas')->update(['is_active' => false]);
        }

        PorfilDesa::create($validatedData);

        return redirect('/dashboard/profil/')->with('success', 'Berhasil di tambahkan.');
    }

    public function editView(PorfilDesa $porfilDesa)
    {
        $data = [
            'bg' => 'withBg',
            'active' => 'profil',
            'nav' => false,
            'title' => 'Admin Serampingan News',
            'contex' => 'Edit Profil Desa',
            'news' => $porfilDesa
        ];

        return view('admin.profil.edit', $data);
    }

    public function edit(PorfilDesa $porfilDesa, Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'title' => 'required|max:255',
            'is_active' => 'required',
            'struktur' => 'image|file|max:1024',
            'informasi' => 'required',
        ];

        $validatedData =  $request->validate($rules);

        if ($request->file('struktur')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['struktur'] = $request->file('struktur')->store('struktur-images');
        }


        PorfilDesa::where('id', $porfilDesa->id)->update($validatedData);

        return redirect('/dashboard/profil/')->with('success', 'Berhasil di ubah.');
    }

    public function info(PorfilDesa $porfilDesa)
    {
        $data = [
            'bg' => 'withBg',
            'active' => 'profil',
            'nav' => false,
            'title' => 'Admin Serampingan News',
            'contex' => 'Info Profil Desa',
            'news' => $porfilDesa
        ];

        return view('admin.profil.info', $data);
    }

    public function activate(PorfilDesa $porfilDesa)
    {
        if (PorfilDesa::all()) {
            DB::table('porfil_desas')->update(['is_active' => false]);
        }
        if ($porfilDesa->is_active == false) {
            PorfilDesa::where('id', $porfilDesa->id)->update([
                'is_active' => true
            ]);
        }
        return back()->with('success', 'Active berhasil di ubah!');
    }

    public function destroy(PorfilDesa $porfildesa)
    {
        // dd($porfildesa);
        Storage::delete($porfildesa->struktur);
        PorfilDesa::destroy($porfildesa->id);
        return back()->with('success', 'Berhasil di hapus!');
    }
}
