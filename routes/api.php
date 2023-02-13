<?php

use Illuminate\Http\Request;
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

Route::middleware('app-locale')->prefix('{locale}')->group(function (){
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get("/user", function (Request $request) {
            return 1;
        });
        Route::post('/logout', ['App\Http\Controllers\AuthController', 'logout']);

    });

    Route::post("/login", [AuthController::class, 'login'])->name('login');
    Route::post('/register', ['App\Http\Controllers\AuthController', 'register']);
});




