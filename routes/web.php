<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ArrearController;
use App\Http\Controllers\UserController;
use App\Models\Arrears;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => 'auth'], function () {

	Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');
	
	// User Series
	Route::get('/profile', [ProfilController::class, 'index']);
	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('list-user', [UserController::class, 'index']);
	Route::get('edit-user/{id}', [UserController::class, 'edit']);
	Route::resource('users', UserController::class);
	Route::get('create-user', [UserController::class, 'create']);

	
	// Major Series
	Route::resource('majors', MajorController::class);
	Route::get('create-major', [MajorController::class, 'create']);
	Route::get('list-major', [MajorController::class, 'index']);
	Route::get('edit-major/{id}', [MajorController::class, 'edit']);

	// Student Series
	Route::resource('students', StudentController::class);
	Route::get('create-student', [StudentController::class, 'create']);
	Route::get('list-student', [StudentController::class, 'index']);
	Route::get('edit-student/{id}', [StudentController::class, 'edit']);
	Route::get('students/{id}', [StudentController::class, 'show']);

	// Payment Series
	Route::resource('payments', PaymentController::class);
	Route::get('create-payment/{student_id}', [PaymentController::class, 'create'])->name('payment.create');
	Route::get('list-payment', [PaymentController::class, 'index']);
	Route::get('edit-payment/{id}', [PaymentController::class, 'edit']);
	Route::get('payments/{id}', [PaymentController::class, 'show']);

	// Arrears Series
	Route::resource('arrears', ArrearController::class);
	Route::get('create-arrear', [ArrearController::class, 'create']);
	Route::get('list-arrear', [ArrearController::class, 'index']);
	Route::get('edit-arrear/{id}', [ArrearController::class, 'edit']);
	Route::get('arrears/{id}', [ArrearController::class, 'show']);


	

	// Account Login
	Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



// Guest Login
Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
