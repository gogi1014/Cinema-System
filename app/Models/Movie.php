<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'cinema';
    protected $primaryKey = 'movieId';
    use HasFactory;
    public $fillable = [
        'movieId',
        'movieImg',
        'movieTrailer',
        'movieTitle',
        'movieGenre',
        'movieDuration',
        'movieRelDate',
        'movieDirector',
        'movieActors',
        'Description',
        'movieLan',
        'movieCat',
        'active'
    ];

    public function searchMovies($input)
    {
        return Movie::where('movieTitle', 'LIKE', '%' . $input->keyword . '%')->get();
    }
    public function getMovies($input)
    {
        $pagg = 5;
        $search = Movie::orderBy('movieId');
        if (isset($input['search'])) {
            $search->where('movieTitle', 'LIKE', "%" . $input["search"] . "%");
        }
        if (isset($input['category'])) {
            $search->where('movieCat', 'LIKE', $input["category"]);
        }
        if (isset($input['genres'])) {
            $search->where('movieGenre', 'LIKE', "%" . $input["genres"] . "%");
        }
        if (isset($input['pagg'])) {
            return $search->paginate($input['pagg']);
        }
        return $search->paginate($pagg);
    }
    public static function store($request)
    {
        $input = $request->input();
        $movie = new Movie();
        $movie->movieImg = $input["movieImg"];
        $movie->movieTitle = $input["movieTitle"];
        $movie->movieGenre = $input["movieGenre"];
        $movie->movieTrailer = $input["movieTrailer"];
        $movie->movieDuration = $input["movieDuration"];
        $movie->movieRelDate = $input["movieRelDate"];
        $movie->movieDirector = $input["movieDirector"];
        $movie->movieActors = $input["movieActors"];
        $movie->Description = $input["Description"];
        $movie->movieCat = $input["movieCat"];
        $movie->movieLan = $input["movieLan"];
        $movie->active = $input["active"];
        $movie->save();
    }
    public function upd($request)
    {
        $input = $request->input();
        $movie = Movie::find($request->movieId);
        $movie->movieTitle = $input["movieTitle"];
        $movie->movieImg = $input["movieImg"];
        $movie->movieTrailer = $input["movieTrailer"];
        $movie->movieGenre = $input["movieGenre"];
        $movie->movieDuration = $input["movieDuration"];
        $movie->movieRelDate = $input["movieRelDate"];
        $movie->movieDirector = $input["movieDirector"];
        $movie->movieActors = $input["movieActors"];
        $movie->Description = $input["Description"];
        $movie->movieCat = $input["movieCat"];
        $movie->movieLan = $input["movieLan"];
        $movie->active = $input["active"];
        $movie->update();
    }
    public function fpMovies()
    {
        $client = Movie::pluck('movieGenre');
        $data=explode(",", $client);
        return $data;
    }
}
