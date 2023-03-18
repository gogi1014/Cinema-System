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
        $input = array("search" => $search, "category" => $category, "genres" => $genres, "pagg" => 3);
        return view('fp', [
            'movies' => $movies->getMovies($input), 'moviesAll' => $moviesAll, 'moviedate' => $moviedate,
            'moviesTrailer' => $moviesTrailer, 'moviesSoon' => $moviesSoon, 'arr' => $movies->fpMovies()]);
    }
    public function ShowContent($primaryKey, Request $request)
    {
        $movies = Movie::find($primaryKey);
        $moviedate = MovieDate::where('MovieId', $primaryKey)->get()->unique('date');
        $movietime = MovieDate::where('date', $request->date)->get();
        $moviesAll = Movie::get()->unique('movieCat');
        $reqDate = $request->date;
        return view('content', [
            'movies' => $movies, 'moviedate' => $moviedate, 'moviesAll' => $moviesAll, 'movietime' => $movietime,
            'reqDate' => $reqDate,'arr' => $movies->fpMovies()]);
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
    
}



?>
