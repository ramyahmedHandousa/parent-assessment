<?php


use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\JsonFileController;


Route::prefix('v1')->group(function () {
    Route::get('/users',JsonFileController::class);
});
