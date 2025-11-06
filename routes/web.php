<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Models\Produk;
use App\Models\Lokasi;
use App\Models\Mutasi;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $produks = Produk::all();
    $lokasis = Lokasi::all();
    $mutasis = Mutasi::with('user')->get();

    return view('dashboard', compact('produks', 'lokasis', 'mutasis'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
