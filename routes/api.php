<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JsonController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/jsonlist', [JsonController::class, 'jsonlist']);
Route::get('/jsonlist/{id}', [JsonController::class, 'show']);
Route::post('/jsonlist', [JsonController::class, 'store'])->name('json.store');
Route::put('/jsonlist/{id}', [JsonController::class, 'update']);
Route::delete('/jsonlist/{id}', [JsonController::class, 'delete']);
