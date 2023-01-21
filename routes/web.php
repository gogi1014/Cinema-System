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
Route::get('/content/{id}/{date?}', [MovieController::class, 'ShowContent']);
Route::get('/search/', [MovieController::class, 'getMovies']);
Route::post('/create', [MovieController::class, 'addBooking']);
Route::get('/addMovie', [MovieController::class, 'insertform']);
Route::post('/createMovie', [MovieController::class, 'addMovie']);
Route::get('/movies', [MovieController::class, 'getMoviesAdmin']);
Route::get('/moviesView', [MovieController::class, 'getMoviesAdminView']);
Route::get('/moviesViewSearch/', [MovieController::class, 'getMoviesAdmin']);
Route::post('/update/{id}', [MovieController::class, 'update']);
Route::delete('/delete/{id}', [MovieController::class, 'delete']);
Route::get('/bookings', [MovieController::class, 'getBookingAdmin']);
Route::get('/bookingsView', [MovieController::class, 'getBookingAdminView']);
Route::post('/updateBookings/{id}', [MovieController::class, 'updateBookings']);
Route::delete('/deleteBookings/{id}', [MovieController::class, 'deleteBookings']);
Route::get('/moviesDate', [MovieController::class, 'getmoviesDateAdmin']);
Route::get('/moviesDateView', [MovieController::class, 'getmoviesDateAdminView']);
Route::get('/addMovieDate', [MovieController::class, 'insertformDate']);
Route::post('/createMovieDate', [MovieController::class, 'addMovieDate']);
Route::post('/updateMoviesDate/{id}', [MovieController::class, 'updateMoviesDate']);
Route::delete('/deleteMoviesDate/{id}', [MovieController::class, 'deleteMoviesDate']);


