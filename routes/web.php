<?php

use App\Http\Controllers\Admin\HotelsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::resource('hotel',HotelsController::class);

Route::get('hotels/{hotel}/{status}', [HotelsController::class, 'updateHotelStatus'])->name('hotel.status');
Route::post('hotels/reject/{id}', [HotelsController::class, 'updateRejectMessage'])->name('hotel.reject');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
