<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(
    ['prefix' => 'verification', 'as' => 'laravel2step::', 'namespace' => 'jeremykenedy\laravel2step\App\Http\Controllers', 'middleware' => ['web']],
    function () {
        Route::get('/needed', ['uses' => 'TwoStepController@showVerification'])->name('verificationNeeded');
        Route::post('/verify', ['uses' => 'TwoStepController@verify'])->name('verify');
        Route::post('/resend', ['uses' => 'TwoStepController@resend'])->name('resend');
    }
);
Route::middleware(['twostep'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

