<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\EsewaPaymentController;
use App\Http\Controllers\Admin\HotelManageController;
use App\Http\Controllers\Admin\HotelsController;
use App\Http\Controllers\Admin\HotelServicesController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\RoomsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Frontend\HomesController;
use App\Http\Controllers\Frontend\HotelController;
use App\Http\Controllers\Frontend\RoomController;
use App\Http\Controllers\Frontend\UsersController;
use App\Http\Controllers\HotelAboutUssController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomesController::class, 'index'])->name('frontend.home');
Route::get('hotel/list', [HomesController::class, 'listHotels'])->name('hotel.list');
Route::get('hotels/{slug}', [HotelController::class, 'hotelDetail'])->name('hotel.detail');
Route::get('{slug}/select/room', [HotelController::class, 'userSelectedRooms'])->name('userselect.room');
// Route::get('{hotelSlug}/rooms/{slug}', [HotelController::class, 'roomDetail'])->name('room.detail');
Route::get('aboutus/{slug}',[HotelController::class,'aboutUs'])->name('hotelss.aboutus');
Route::get('sevicess/{slug}',[HotelController::class,'services'])->name('hotelss.services');
Route::get('contactus/{slug}',[HotelController::class,'contactus'])->name('hotelss.contactus');
Route::resource('contact-us',ContactController::class);



Route::get('/hotel/{slug}/rooms', [RoomController::class, 'index'])->name('hotelroom.list');
Route::get('rooms/{id}', [RoomController::class, 'roomDetails'])->name('room.details');
Route::post('/store-selected-rooms', [RoomController::class, 'storeSelectedRooms'])->name('store.selected.rooms');
// to remove the room from the cart
Route::get('/remove-room/{id}', [HotelController::class,'removeRoom'])->name('remove.room');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('user/dashboard', [UsersController::class, 'index'])->name('user.dashboard');
    // Route::post('review/store',[ReviewController::class,'store'])->name('review.store');
    Route::post('booking',[BookingController::class,'bookroom'])->name('room.book');
    Route::post('booking-payment',[BookingController::class,'paymentbook'])->name('payment.book');
    Route::get('payment/success',[BookingController::class,'paymentSuccess'])->name('booking.success');
    Route::get('payment/failed',[BookingController::class,'paymentFailed'])->name('booking.failed');
    Route::post('booking/cancel',[BookingController::class,'cancelBooking'])->name('booking.cancel');
});
 Route::resource('review',ReviewController::class);


Route::middleware(['auth','hotel_owner'])->group(function () {
    // to manage the hotel 
    Route::get('hotel/manage', [HotelManageController::class, 'index'])->name('manage.hotel');
});

Route::get('esewa/pay', [EsewaPaymentController::class, 'pay'])->name('esewa.pay');
Route::get('esewa/check', [EsewaPaymentController::class, 'check'])->name('esewa.check');




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route for the normal user
Route::middleware(['auth','admin'])->group(function () {
    Route::resource('category', CategoriesController::class);
    Route::resource('room', RoomsController::class);
    Route::resource('hotelservice',HotelServicesController::class);
    Route::resource('hotelaboutus',HotelAboutUssController::class);
});

// Route for the super admin
Route::middleware(['super_admin'])->group(function () {
    Route::get('hotels/{hotel}/{status}', [HotelsController::class, 'updateHotelStatus'])->name('hotel.status');
    Route::post('hotels/reject/{id}', [HotelsController::class, 'updateRejectMessage'])->name('hotel.reject');
    Route::get('hotel/feature/{id}',[HotelsController::class,'makeHotelFeature'])->name('hotel.feature');

    Route::get('/users/list',[UsersController::class,'userList']);
    // Route::get('/user/{id}', [UsersController::class, 'blockUser'])->name('user.block');
    // Route::get('/user/{id}/view',[UsersController::class,'viewUserDetails'])->name('user.show');
});
Route::resource('hotel', HotelsController::class);
