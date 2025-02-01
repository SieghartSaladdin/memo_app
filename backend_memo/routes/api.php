<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/memo-data', [MemoController::class, 'index']);
Route::post('/create-memo', [MemoController::class, 'store']);
Route::delete('/delete-memo-{id}', [MemoController::class, 'destroy']);
Route::post('/togglearsip-memo-{id}', [MemoController::class, 'toggleArsip']);
