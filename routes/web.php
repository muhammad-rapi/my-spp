<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\StudentController;
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
	
	Route::get('/logout', [SessionsController::class, 'destroy']);

	
	// Major Series
	// Route::get('/create-major', [MajorController::class, 'create']);
	// Route::post('/add-major', [MajorController::class, 'store']);
	// Route::get('/list-major', [MajorController::class, 'index']);
	// Route::get('/update-major/{id}', [MajorController::class, 'edit']);
	// Route::patch('/update-major/{id}', [MajorController::class, 'update']);
	// Route::delete('/delete-major/{id}', [MajorController::class, 'destroy']);
	
	Route::resource('majors', MajorController::class);
	Route::get('create-major', [MajorController::class, 'create']);
	Route::get('list-major', [MajorController::class, 'index']);
	Route::get('edit-major/{id}', [MajorController::class, 'edit']);


	// Student Series
	// Route::get('/create-student', [StudentController::class, 'create']);
	// Route::post('/add-student', [StudentController::class, 'store']);
	// Route::get('/list-student', [StudentController::class, 'index']);
	// Route::get('/student/{id}', [StudentController::class, 'show']);
	// Route::get('/update-student/{id}', [StudentController::class, 'edit']);
	// Route::patch('/update-student/{id}', [StudentController::class, 'update']);
	// Route::delete('/delete-student/{id}', [StudentController::class, 'destroy']);


	Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



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