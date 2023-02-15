<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\CovidController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|f
*/

Route::prefix('{locale?}')->middleware('app-locale')->group(function (){
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/country', [CountryController::class, 'index']);
        Route::get('/covid', [CovidController::class, 'index']);
        Route::get('/summary', [CovidController::class, 'summary']);
    });

    Route::post("/login", [AuthController::class, 'login'])->name('login');
    Route::get("/login", [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register']);
});




