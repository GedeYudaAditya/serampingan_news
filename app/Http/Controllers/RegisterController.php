<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('admin.keamanan.tambah', [
            'bg' => 'withBg',
            'active' => 'keamanan',
            'nav' => false,
            'title' => 'Admin Serampingan News',
            'contex' => 'Keamanan',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
            'password_confirmation' => 'required|min:5|max:255'
        ]);

        // $validatedData['password'] = bcrypt($validatedData['password']);
        if ($validatedData['password'] != $validatedData['password_confirmation']) {
            return back()->with('failed', 'Password tidak sama!');
        }

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        // $request->session()->flash('success', 'Registration successfull! Pleas login');
        return back()->with('success', 'Registration successfull! Pleas login');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Delete successfull!');
    }
}
