<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;

class MovieController extends Controller
{
    public function getMovies(Request $request)
    {
        $movies = new Movie();
        $search = $request->input('search');
        $input =array("search" => $search,"pagg" => 2);
        
        return view('fp', ['movies' => $movies->getMovies($input)]);
    }
    public function ShowContent($primaryKey)
    {
        $movies = Movie::find($primaryKey);
        return view('content',['movies'=>$movies]);
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
        return ['success'=>true];
    }
    public function delete($id)
    {
        $movie = new Movie;
        $movie = Movie::find($id);
        if(!$movie){
            return ["status"=>false,"message" => "Movie not found"];
        }
        $movie->delete();
        return ["status"=>true];

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
        return ['success'=>true];
    }
    public function deleteBookings($id)
    {
        $movie = new User;
        $movie = User::find($id);
        if(!$movie){
            return ["status"=>false,"message" => "Booking not found"];
        }
        $movie->delete();
        return ["status"=>true];

    }  
}