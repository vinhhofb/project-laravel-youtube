<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ForderController;

Route::get('/{any}', function () {
    return view('welcome');
})->where('any','.*');
