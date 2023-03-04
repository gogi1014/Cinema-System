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
        $moviesTrailer = Movie::get()->take(6);
        $moviesSoon = Movie::where('active', '0')->get();
        $moviesAll = Movie::get()->unique('movieCat');
        $search = $request->input('search');
        $category = $request->input('category');
        $genres = $request->input('genres');
        $client = Movie::select(
            Movie::raw('SUBSTRING_INDEX(movieGenre, ",", 1) as movieGenres'),
            Movie::raw('SUBSTRING_INDEX(SUBSTRING_INDEX(movieGenre, ",", 2), ",", -1) as movieGenress'),
            Movie::raw('SUBSTRING_INDEX(SUBSTRING_INDEX(movieGenre, ",", 3), ",", -1) as movieGenresss')
        )->get()->unique('movieGenres', 'movieGenress', 'movieGenresss');
        $arr = array();
        foreach ($client as $item) {
            array_push($arr, $item['movieGenres']);
            array_push($arr, $item['movieGenress']);
            array_push($arr, $item['movieGenresss']);
        }
        $input = array("search" => $search, "category" => $category, "genres" => $genres, "pagg" => 3);
        return view('fp', [
            'movies' => $movies->getMovies($input), 'moviesAll' => $moviesAll, 'moviedate' => $moviedate,
            'moviesTrailer' => $moviesTrailer, 'moviesSoon' => $moviesSoon, 'arr' => $arr]);
    }
    public function ShowContent($primaryKey, Request $request)
    {
        $movies = Movie::find($primaryKey);
        $moviedate = MovieDate::where('MovieId', $primaryKey)->get()->unique('date');
        $movietime = MovieDate::where('date', $request->date)->get();
        $moviesAll = Movie::get()->unique('movieCat');
        $reqDate = $request->date;
        $reqTime = $request->time;
        return view('content', [
            'movies' => $movies, 'moviedate' => $moviedate, 'moviesAll' => $moviesAll, 'movietime' => $movietime,
            'reqDate' => $reqDate, 'reqTime' => $reqTime,'arr' => $movies->fpMovies()]);
    }
    function addBooking(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|string|min:3|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|min:3|max:255',
        ]);
        User::store($request);
        return redirect('')->with('success', 'Your form has been submitted.');
    }
    public function getMoviesAdmin(Request $request)
    {
        $cinema = (new Movie)->searchMovies($request);
        return response()->json($cinema);
    }
    public function getMoviesAdminView(Request $request)
    {
        return view('showMovies');
    }
    public function update(Request $request)
    {

        (new Movie)->upd($request);
        return ['success' => true];
    }
    public function delete($id)
    {
        $movie = new Movie;
        $movie = Movie::find($id);
        if (!$movie) {
            return ["status" => false, "message" => "Movie not found"];
        }
        $movie->delete();
        return ["status" => true];
    }
    public function insertform()
    {
        return view('addMovie');
    }
    function addMovie(Request $request)
    {
        $this->validate($request, [
            'movieTitle' => 'required|string|min:3|max:255',
            'movieGenre' => 'required|string|max:255',
            'movieDuration' => 'required|int',
            'movieDirector' => 'required|string|max:255',
            'movieActors' => 'required|string|max:255',
            'Description' => 'required|string|max:255',
            'movieCat' => 'required|string|max:255',
            'movieLan' => 'required|string|max:255',
        ]);
        Movie::store($request);
        return redirect('/moviesView')->with('success', 'Your form has been submitted.');
    }

    public function getBookingAdmin(Request $request)
    {
        $user = User::get();
        return response()->json($user);
    }
    public function getBookingAdminView(Request $request)
    {
        return view('showBookings');
    }
    public function updateBookings(Request $request)
    {

        (new User)->upd($request);
        return ['success' => true];
    }
    public function deleteBookings($id)
    {
        $movie = new User;
        $movie = User::find($id);
        if (!$movie) {
            return ["status" => false, "message" => "Booking not found"];
        }
        $movie->delete();
        return ["status" => true];
    }
    public function getmoviesDateAdmin(Request $request)
    {
        $user = MovieDate::get();
        return response()->json($user);
    }
    public function getmoviesDateAdminView(Request $request)
    {
        return view('showMovieDate');
    }
    public function insertformDate($primaryKey = null, Request $request)
    {
        if ($primaryKey == null) {
            $primaryKey = 1;
        }
        $movies = Movie::get();
        $movietitle = Movie::where('movieTitle', $primaryKey)->first();

        $reqTitle = $request->MovieName;
        return view('addMovieDate', ['movies' => $movies, 'movietitle' => $movietitle, 'reqTitle' => $reqTitle]);
    }
    function addMovieDate(Request $request)
    {
        $this->validate($request, [
            'movieTitle' => 'required|string|min:3|max:255',
            'time' => 'required|string|max:255',
            'date' => 'required|date',
        ]);
        MovieDate::store($request);

        return redirect('/moviesDateView')->with('success', 'Your form has been submitted.');
    }
    public function updateMoviesDate(Request $request)
    {

        (new MovieDate)->upd($request);
        return ['success' => true];
    }
    public function deleteMoviesDate($id)
    {
        $movie = new MovieDate();
        $movie = MovieDate::find($id);
        if (!$movie) {
            return ["status" => false, "message" => "Booking not found"];
        }
        $movie->delete();
        return ["status" => true];
    }
}

?>
