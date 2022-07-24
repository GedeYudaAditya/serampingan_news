<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'active' => 'berita',
            'title' => 'Tambah Berita | Admin Serampingan News',
            'contex' => 'Tambah Berita'
        ];

        return view('admin.berita.tambah', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBeritaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        preg_match_all("/<p.*?>(.*)<\/p>/U", $request['body'], $matches);
        $shortPart = array();
        $stoper = 0;
        foreach ($matches[0] as $key) {
            if ($stoper == 1) {
                break;
            } else {
                array_push($shortPart, $key);
            }
            $stoper++;
        }

        $excerpt = implode(" ", $shortPart);
        $request['excerpt'] = $excerpt;

        $validatedData = $request->validate([
            'category_id' => 'required',
            'user_id' => 'required',
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:beritas',
            'thumbnail' => 'required|image|file|max:2048',
            'excerpt' => 'required',
            'body' => 'required',
        ]);

        $category_id = Category::firstWhere('name', $request['category_id']);
        if (isset($category_id)) {
            $validatedData['category_id'] = $category_id->id;
        } else {
            $data = [
                'name' => $request['category_id'],
                'slug' => strtolower($request['category_id'])
            ];
            Category::create($data);
            $category_id = Category::firstWhere('name', $request['category_id']);
            $validatedData['category_id'] = $category_id->id;
        }
        // dd($matches);
        //
        // dd($request);

        $validatedData['thumbnail'] = $request->file('thumbnail')->store('thumbnail-images');

        Berita::create($validatedData);

        return redirect('/dashboard/berita/')->with('success', 'Berita berhasil di tambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show(Berita $berita)
    {
        $data = [
            'active' => 'berita',
            'title' => $berita->title . ' | Admin Serampingan News',
            'contex' => 'Edit Berita',
            'news' => $berita
        ];

        return view('admin.berita.info', $data);
    }

    public function editView(Berita $berita)
    {
        $data = [
            'active' => 'berita',
            'title' => $berita->title . ' | Admin Serampingan News',
            'contex' => 'Edit Berita',
            'news' => $berita,
        ];

        return view('admin.berita.edit', $data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit(Berita $berita, Request $request)
    {

        preg_match_all("/<p.*?>(.*)<\/p>/U", $request['body'], $matches);
        $shortPart = array();
        $stoper = 0;
        foreach ($matches[0] as $key) {
            if ($stoper == 1) {
                break;
            } else {
                array_push($shortPart, $key);
            }
            $stoper++;
        }

        $excerpt = implode(" ", $shortPart);
        $request['excerpt'] = $excerpt;

        $rules = [
            'category_id' => 'required',
            'user_id' => 'required',
            'title' => 'required|max:255',
            'excerpt' => 'required',
            'thumbnail' => 'image|file|max:2048',
            'body' => 'required',
        ];

        if ($request->slug != $berita->slug) {
            $rules['slug'] = 'required|max:255|unique:beritas';
        }

        // dd($request);

        $validatedData = $request->validate($rules);

        $category_id = Category::firstWhere('name', $request['category_id']);
        if (isset($category_id)) {
            $validatedData['category_id'] = $category_id->id;
        } else {
            $data = [
                'name' => $request['category_id'],
                'slug' => strtolower($request['category_id'])
            ];
            Category::create($data);
            $category_id = Category::firstWhere('name', $request['category_id']);
            $validatedData['category_id'] = $category_id->id;
        }
        // dd($matches);
        //

        if ($request->file('thumbnail')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('thumbnail-images');
        }

        Berita::where('slug', $berita->slug)->update($validatedData);

        return redirect('/dashboard/berita/')->with('success', 'Berita berhasil di edit.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBeritaRequest  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBeritaRequest $request, Berita $berita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berita $berita)
    {
        Storage::delete($berita->thumbnail);
        Berita::destroy($berita->id);
        return back()->with('success', 'Berita berhasil di hapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Berita::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
