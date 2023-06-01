<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use Illuminate\Auth\AuthenticatedSessionController;


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
    return view('auth.login');
});

Route::get('layouts/dash', function () {
    return view('layouts.dash');
})->name('layouts.dash');

Route::get('layouts/registered', function () {
    return view('layouts.registered');
})->name('layouts.registered');
Route::get('layouts/file', function () {
    return view('layouts.file');
})->name('layouts.file');

Auth::routes();

Route::get('/dash', [App\Http\Controllers\HomeController::class, 'index'])->name('dash');
Route::get('/home', 'TableController@index')->name('table');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::post('/logout', function () {Auth::logout();return redirect('/');})->name('logout.post');
Route::get('/students/add', [StudentController::class, 'index'])->name('addStudent');

Route::middleware(['web', 'auth', 'verified'])->group(function () {
    Route::get('/students', 'StudentController@index')->name('students.index');
});
