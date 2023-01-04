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
        $cinema = Movie::get();
        return response()->json($cinema);
    } 
    public function getMoviesAdminView(Request $request)
    {
        return view('showMovies');
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
    public function update(Request $request)
    {
       
        (new Movie)->upd($request);
        return ['success'=>true];
    }
}