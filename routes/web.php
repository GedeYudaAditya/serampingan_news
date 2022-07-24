<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PorfilDesaController;
use App\Http\Controllers\RegisterController;
use App\Models\WebImgManagement;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// splash route
Route::get('/', [GuestController::class, 'index']);

// beranda route
Route::get('/beranda', [GuestController::class, 'beranda'])->name('beranda');

// profil route
Route::get('/profil', [GuestController::class, 'porfil']);

// struktur desa route
Route::get('/struktur', [GuestController::class, 'strukturDesa']);

// open page berita
Route::get('/post/{berita:slug}', [GuestController::class, 'post']);

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/login', [AdminController::class, 'authenticate']);
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::post('/dashboard/bg', [AdminController::class, 'img'])->name('bg');
    Route::post('/dashboard/splash', [AdminController::class, 'splashImg']);

    Route::get('/dashboard/keamanan', [AdminController::class, 'keamanan']);
    Route::post('/dashboard/keamanan', [AdminController::class, 'ubahKeamanan']);

    Route::get('/dashboard/berita', [AdminController::class, 'berita']);

    Route::get('/dashboard/berita/tambah', [BeritaController::class, 'index'])->name('tambahBerita');
    Route::post('/dashboard/berita/tambah', [BeritaController::class, 'store']);

    Route::get('/dashboard/berita/info/{berita:slug}', [BeritaController::class, 'show']);

    Route::get('/dashboard/berita/edit/{berita:slug}', [BeritaController::class, 'editView']);
    Route::post('/dashboard/berita/edit/{berita:slug}', [BeritaController::class, 'edit']);

    Route::post('/dashboard/berita/delete/{berita:slug}', [BeritaController::class, 'destroy']);

    Route::get('/dashboard/profil', [PorfilDesaController::class, 'index']);

    Route::get('/dashboard/profil/info/{porfilDesa:id}', [PorfilDesaController::class, 'info'])->name('infoProfil');

    Route::get('/dashboard/profil/tambah', [PorfilDesaController::class, 'storeView'])->name('tambahProfil');
    Route::post('/dashboard/profil/tambah', [PorfilDesaController::class, 'store'])->name('addProfil');

    Route::get('/dashboard/profil/edit/{porfilDesa:id}', [PorfilDesaController::class, 'editView'])->name('editProfil');
    Route::post('/dashboard/profil/edit/{porfilDesa:id}', [PorfilDesaController::class, 'edit']);

    Route::post('/dashboard/profil/activate/{porfilDesa:id}', [PorfilDesaController::class, 'activate']);

    Route::post('/dashboard/profil/delete/{porfildesa:id}', [PorfilDesaController::class, 'destroy']);

    Route::get('/dashboard/tambah-user', [RegisterController::class, 'index'])->name('tambahUser');
    Route::post('/dashboard/tambah-user', [RegisterController::class, 'store'])->name('addUser');
    Route::post('/dashboard/user/delete/{user:username}', [RegisterController::class, 'destroy']);

    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
});
Route::get('/forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/dashboard/berita/createSlug', [BeritaController::class, 'checkSlug']);
