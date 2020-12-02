<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Datacontroller;

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
Route::group(['namespace' => 'API'], function () {
    Route::post('me', [AuthController::class, 'login'])->name('auth.login');
    Route::delete('me', [AuthController::class, 'logout']);
    Route::get('data', [Datacontroller::class, 'index']);

    Route::group(['middleware' => 'auth'], function () {



    });
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
});
