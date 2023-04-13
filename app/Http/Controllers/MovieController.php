<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MovieDate;
use Mail;

class MovieController extends Controller
{
    public function getMovies(Request $request)
    {
        $movies = new Movie();
        $moviedate = MovieDate::get();
        $moviesSoon = Movie::where('active', '0')->get();
        $moviesSoonn = Movie::all();
        $search = $request->input('search');
        $category = $request->input('category');
        $genres = $request->input('genres');
        $input = array("search" => $search, "category" => $category, "genres" => $genres, "pagg" => 3);
        $movieCount = Movie::count(); 
        return view('fp', [
            'movieCount' => $movieCount,'movies' => $movies->getMovies($input, $request), 'moviesAll' => $movies->getAllMovies(), 'movieSoon' => $moviesSoonn, 'moviedate' => $moviedate,
            'moviesSoon' => $moviesSoon, 'arr' => $movies->fpMovies()
        ]);
    }
    public function jsonGetMovies(Request $request)
    {
        $query = User::select('*');

            $query->where('movieTitle', 'like', "%{$request->input('name')}%");
        
            return response()->json($query);
    }
    public function ShowContent($primaryKey, Request $request)
    {
        $movies = Movie::find($primaryKey);
        $moviesAll = new Movie();
        $moviedate = new MovieDate();
        $reqDate = $request->date;
        $reqTime = $request->time;
        return view('content', [
            'movies' => $movies, 'moviedate' => $moviedate->getMovieDate($primaryKey), 'moviesAll' => $moviesAll->getAllMovies(), 'movietime' => $moviedate->get2D($request),
            'movietimee' => $moviedate->get3D($request), 'reqDate' => $reqDate, 'reqTime' => $reqTime, 'arr' => $movies->fpMovies(),
            'seatSold' => (new User)->soldSeats($movies, $reqDate, $reqTime)
        ]);
    }
    function addBooking(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|string|min:3|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|min:3|max:255',
        ]);
        User::store($request);
        return redirect('')->with('success', 'Успешно направена резервацията. Проверете имейла си.');
    }

    public function getMovieApi(Request $request)
    {
        $movies = Movie::all();
        $moviess = Movie::find(1);

        $search = $request->input('search');
        return view('map', ['movies' => $movies, 'moviess' => $moviess, 'search' => $search]);
    }
}
