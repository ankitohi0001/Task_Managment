<?php

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
Route::get('/todos', function () {
    return view('todos');
});                                                                                       

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StatusTaskController;
use App\Models\status_task;

	// Route::get('users/create',[\App\Http\Controllers\UserController::class,'create'])->name('user.create');
	// Route::get('users/index',[\App\Http\Controllers\UserController::class,'index'])->name('users');
	// Route::get('tasks/create',[\App\Http\Controllers\TaskController::class,'create'])->name('tasks.create');
	// Route::get('tasks/index',[\App\Http\Controllers\TaskController::class,'index'])->name('tasks');                  
Route::get('/user-tasks/{user_id}', [\App\Http\Controllers\UserController::class, 'userTaskList'])->name('tasks.userTasks');
Route::get('/tasks/{user_id}', [\App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks/updated', [\App\Http\Controllers\TaskController::class, 'updated'])->name('tasks_status.update');
Route::get('login',[LoginController::class,'index'])->name('login');
Route::post('login',[LoginController::class,'login_process'])->name('login_process');
Route::middleware(['auth','CheckRole'])->group(function () {
    Route::get('/taskes', [\App\Http\Controllers\TaskeController::class, 'index'])->name('taskes.index');
	Route::group(['prefix' => 'admin'], function () {
		Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
		Route::resource('users',\App\Http\Controllers\UserController::class);
		Route::resource('tasks',\App\Http\Controllers\TaskController::class);
		Route::resource('project',ProjectController::class);
		Route::get('/status',[StatusTaskController::class,'index'])->name('statustasks.index');
		
	});
	
});
Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::resource('list',DataController::class);
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('rtl', function () {
		return view('pages.rtl');
	})->name('rtl');
	Route::get('virtual-reality', function () {
		return view('pages.virtual-reality');
	})->name('virtual-reality');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
