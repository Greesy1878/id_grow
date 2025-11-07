<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ProdukApiController;
use App\Http\Controllers\Api\LokasiApiController;
use App\Http\Controllers\Api\MutasiApiController;

Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    // Produk CRUD
    Route::apiResource('produk', ProdukApiController::class);
    // DELETE produk sudah otomatis ada via apiResource

    // Lokasi CRUD
    Route::apiResource('lokasi', LokasiApiController::class);
    Route::get('lokasi/{id}/produk', [LokasiApiController::class, 'produkList']);
    Route::post('lokasi/{id}/produk', [LokasiApiController::class, 'addProduk']);
    // DELETE lokasi otomatis via apiResource

    // Mutasi (index, store, show)
    Route::apiResource('mutasi', MutasiApiController::class)->only(['index', 'store', 'show']);
    Route::get('produk/{id}/mutasi', [MutasiApiController::class, 'historyByProduk']);
    Route::get('user/{id}/mutasi', [MutasiApiController::class, 'historyByUser']);

    // Jika mau DELETE mutasi, tambahkan route manual
    Route::delete('mutasi/{id}', [MutasiApiController::class, 'destroy']);

    Route::post('/logout', [AuthApiController::class, 'logout']);
});
