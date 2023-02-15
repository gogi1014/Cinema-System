<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\MovieDate;
use App\Models\Movie;
use App\Models\User;




class AdminAuthController extends Controller
{
    public function getLogin(){
        return view('admin.auth.login');
    }
 
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
 
        $model = Admin::query()->where('email', $request->get('email'))->firstOrFail();

        if(!$model){
            return back()->with('error', 'Email or password is incorrect');
        }
        if (!Hash::check($request->get('password'), $model->password)) {
            return back()->with('error', 'Email or password is incorrect');
        }

        Auth::guard('admin')->login($model);

        return redirect()->route('adminDashboard')
            ->with('success', 'Welcome ' . $model->name . '!');
    }
 
    public function adminLogout(Request $request)
    {
        auth()->guard('admin')->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');
        return redirect(route('adminLogin'));
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
            'Description' => 'required|string',
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
    public function insertformDate($primaryKey = null,Request $request)
    {
        if ($primaryKey == null) {
            $primaryKey = 1;
        }
        $movies = Movie::get();
        $movietitle = Movie::where('movieTitle', $primaryKey)->first();
        
        $reqTitle = $request->MovieName;
        return view('addMovieDate', ['movies' => $movies,'movietitle' => $movietitle,'reqTitle' => $reqTitle]);
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
