<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ProdukApiController;
use App\Http\Controllers\Api\LokasiApiController;
use App\Http\Controllers\Api\MutasiApiController;

Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('produk', ProdukApiController::class);

    Route::apiResource('lokasi', LokasiApiController::class);
    Route::get('lokasi/{id}/produk', [LokasiApiController::class, 'produkList']);
    Route::post('lokasi/{id}/produk', [LokasiApiController::class, 'addProduk']);

    Route::apiResource('mutasi', MutasiApiController::class)->only(['index', 'store', 'show']);
    Route::get('produk/{id}/mutasi', [MutasiApiController::class, 'historyByProduk']);
    Route::get('user/{id}/mutasi', [MutasiApiController::class, 'historyByUser']);

    Route::post('/logout', [AuthApiController::class, 'logout']);
});
