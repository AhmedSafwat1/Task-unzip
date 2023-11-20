<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZipController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\AuthController;

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


// Auth route
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard'])->name("dashboard.home");
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Route
Route::group(["prefix" => "/dashboard","as" => "dashboard." , "middleware"=>["auth"]], function ($route) {
    $route->resource("zip", ZipController::class);
    $route->resource("pages", PageController::class)->except("show");
});


Route::get("pages/{slug}", [PageController::class, "show"])->name("website.page");
