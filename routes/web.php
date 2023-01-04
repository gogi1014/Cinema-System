<?php

use App\Http\Controllers\MovieController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('', [MovieController::class, 'getMovies']);
Route::get('/content/{id}', [MovieController::class, 'ShowContent']);
Route::get('/search/', [MovieController::class, 'getMovies']);
Route::post('/create', [MovieController::class, 'addBooking']);
Route::get('/movies', [MovieController::class, 'getMoviesAdmin']);
Route::get('/moviesView', [MovieController::class, 'getMoviesAdminView']);
Route::get('/bookings', [MovieController::class, 'getBookingAdmin']);
Route::get('/bookingsView', [MovieController::class, 'getBookingAdminView']);
Route::post('update/{id}', [MovieController::class, 'update']);
