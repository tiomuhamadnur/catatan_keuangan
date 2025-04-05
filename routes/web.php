<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LocationController;
use App\Http\Controllers\admin\StatusController;
use App\Http\Controllers\admin\UnitController;
use App\Http\Controllers\user\AbsorptionController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\user\ProjectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
})->middleware('guest');

Auth::routes();

Route::get('/home', function () {
    return redirect()->route('dashboard.index');
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('/dashboard', DashboardController::class);

    Route::resource('/category', CategoryController::class);

    Route::resource('/status', StatusController::class);

    Route::resource('/profile', ProfileController::class);

    Route::resource('/location', LocationController::class);

    Route::resource('/project', ProjectController::class);

    Route::resource('/absorption', AbsorptionController::class);

    Route::resource('/unit', UnitController::class);
});
