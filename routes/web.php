<?php

use App\Http\Controllers\Backend\GuestController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\ReservationController;
use App\Http\Controllers\Backend\Master\UserController;
use App\Http\Controllers\Backend\Master\CategoryController;
use App\Http\Controllers\Backend\Master\RoleController;
use App\Http\Controllers\Backend\Master\PermissionController;
use App\Http\Controllers\Backend\Master\DebitCardController;
use App\Http\Controllers\Backend\Master\DiscountController;
use App\Http\Controllers\Backend\RoomAcomodationController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Backend\StaffController;
use App\Http\Controllers\Backend\SettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
	Route::get('/', [HomeController::class, 'index']);

	//Check in
	Route::get('/check-in', [ReservationController::class, 'checkin'])->name('checkin');
	Route::post('/check-in', [ReservationController::class, 'checkin'])->name('checkin');
	Route::get('/check-in/{no}', [ReservationController::class, 'checkin_create'])->name('checkin.create');
	Route::post('/check-in/check', [ReservationController::class, 'checkin_store'])->name('checkin.store');
	Route::get('/check-in/billing/{id}', [ReservationController::class, 'billing'])->name('billing');
	Route::get('/check-in/stroke/{id}', [ReservationController::class, 'stroke'])->name('stroke');

	//Check room
	Route::get('/check-room', [ReservationController::class, 'check'])->name('check');
	Route::get('/check-room/acomodation/{id}', [ReservationController::class, 'check_acomodation'])->name('check.show');

	//Check out
	Route::get('/check-out', [ReservationController::class, 'checkout'])->name('checkout');
	Route::get('/check-out/{no}', [ReservationController::class, 'checkout_create'])->name('checkout.create');
	Route::post('/check-out/{id}/check', [ReservationController::class, 'checkout_store'])->name('checkout.store');

	//Report
	Route::get('/report', [HomeController::class, 'report'])->name('report.index');
	Route::get('/report/export', [HomeController::class, 'export'])->name('report.export');

	//Guest in house
	Route::get('/guest-in-house', [GuestController::class, 'guest_in_house'])->name('guest.inhouse');

	// Master
	Route::resource('/home', HomeController::class);
	Route::resource('/card', DebitCardController::class);
	Route::resource('/discount', DiscountController::class);
	Route::resource('/category', CategoryController::class);
	Route::resource('/user', UserController::class);
	Route::resource('/role', RoleController::class);
	Route::resource('/permission', PermissionController::class);

	Route::post('/role/{id}/give-permission', [RoleController::class, 'give_permission'])->name('give_permission');

	// Features
	Route::resource('/guest', GuestController::class);
	Route::resource('/room', RoomController::class);
	Route::resource('/staff', StaffController::class);
	Route::resource('/roomacomodation', RoomAcomodationController::class);
	Route::resource('/setting', HomeController::class);
	Route::get('/setting', [HomeController::class, 'setting'])->name('home.setting');

	//Account Update 
	Route::post('/user/{id}', [StaffController::class, 'update_acc'])->name('update.acc');
});

// Route::resource('/profile', UserController::class);

Auth::routes(['register' => false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
