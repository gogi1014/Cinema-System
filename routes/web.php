<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\Admin\AdminAuthController;
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
Route::get('/fpMovies', [MovieController::class, 'jsonGetMovies']);

Route::get('/content/{id}/{date?}/{time?}', [MovieController::class, 'ShowContent']);
Route::get('/search/', [MovieController::class, 'getMovies']);
Route::post('/create', [MovieController::class, 'addBooking']);

Route::get('/aaa', [MovieController::class, 'getMovieApi']);
Route::post('/aaa', [MovieController::class, 'getMovieApi']);



Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
    Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
    Route::get('/logout', [AdminAuthController::class, 'adminLogout']);

    Route::group(['middleware' => 'adminauth'], function () {
        Route::get('/', [AdminAuthController::class, 'getCount'])->name("adminDashboard");
        Route::get('/addMovie', [AdminAuthController::class, 'insertform']);
        Route::post('/createMovie', [AdminAuthController::class, 'addMovie']);
        Route::get('/movies', [AdminAuthController::class, 'getMoviesAdmin']);
        Route::get('/moviesView', [AdminAuthController::class, 'getMoviesAdminView']);
        Route::get('/moviesViewSearch/', [AdminAuthController::class, 'getMoviesAdmin']);
        Route::post('/update/{id}', [AdminAuthController::class, 'update']);
        Route::delete('/delete/{id}', [AdminAuthController::class, 'delete']);
        Route::delete('/deleteMultiMovies', [AdminAuthController::class, 'deleteMultiMovies']);
        Route::get('/bookings', [AdminAuthController::class, 'getBookingAdmin']);
        Route::get('/bookingsView', [AdminAuthController::class, 'getBookingAdminView']);
        Route::get('/bookingsViewSearch/', [AdminAuthController::class, 'getBookingAdmin']);
        Route::post('/updateBookings/{id}', [AdminAuthController::class, 'updateBookings']);
        Route::delete('/deleteBookings/{id}', [AdminAuthController::class, 'deleteBookings']);
        Route::delete('/deleteMultiBookings', [AdminAuthController::class, 'deleteMultiBookings']);
        Route::get('/moviesDate', [AdminAuthController::class, 'getmoviesDateAdmin']);
        Route::get('/moviesDateView', [AdminAuthController::class, 'getmoviesDateAdminView']);
        Route::get('/addMovieDate/{MovieName?}', [AdminAuthController::class, 'insertformDate']);
        Route::post('/createMovieDate', [AdminAuthController::class, 'addMovieDate']);
        Route::post('/updateMoviesDate/{id}', [AdminAuthController::class, 'updateMoviesDate']);
        Route::delete('/deleteMoviesDate/{id}', [AdminAuthController::class, 'deleteMoviesDate']);
        Route::delete('/deleteMultiMoviesDate', [AdminAuthController::class, 'deleteMultiMoviesDate']);
    });
});