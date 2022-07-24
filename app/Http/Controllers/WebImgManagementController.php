<?php

namespace App\Http\Controllers;

use App\Models\WebImgManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebImgManagementController extends Controller
{
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
            Storage::remove(WebImgManagement::first()->splash_image1);
            Storage::remove(WebImgManagement::first()->splash_image2);
            Storage::remove(WebImgManagement::first()->splash_image3);

            WebImgManagement::where('id', 1)->update([
                'splash_image1' => $request->file('splash_image1')->store('splash-images'),
                'splash_image2' => $request->file('splash_image2')->store('splash-images'),
                'splash_image3' => $request->file('splash_image3')->store('splash-images'),
            ]);
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
