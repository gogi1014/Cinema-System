<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieDate extends Model
{
    protected $table = 'moviedates';
    use HasFactory;
    public $timestamps = false;
    public $fillable = [
        'id',
        'MovieId',
        'MovieName',
        'date',
        'time',
        'type',
    ];
    public function searchMovie($request)
    {
        if ($request->searchDateModel != 'default') {
            if ($request->searchTimeModel != 'default') {
                return MovieDate::where('time', 'LIKE', '%' . $request->searchTimeModel . '%')->where('date', 'LIKE', '%' . $request->searchDateModel . '%')->get();
            } else {
                return MovieDate::where('date', 'LIKE', '%' . $request->searchDateModel . '%')->get();
            }
        }
        if ($request->searchModel == 'MovieName') {
            return MovieDate::where('MovieName', 'LIKE', '%' . $request->keyword . '%')->get();
        }
        if ($request->searchModel == 'id') {
            return MovieDate::where('id', 'LIKE', '%' . $request->keyword . '%')->get();
        }
        if ($request->searchModel == 'MovieId') {
            return MovieDate::where('MovieId', 'LIKE', '%' . $request->keyword . '%')->get();
        }
    }
    public function getMovieDate($primaryKey)
    {
        return MovieDate::where('MovieId', $primaryKey)->get()->unique('date');
    }
    public function get2D($request)
    {
        return MovieDate::where('date', $request->date)->where('type', '2D')->get();
    }
    public function get3D($request)
    {
        return MovieDate::where('date', $request->date)->where('type', '3D')->get();
    }
    public static function store($request)
    {
        $input = $request->input();
        $movie = new MovieDate();
        $movie->MovieId = $input["MovieId"];
        $movie->MovieName = $input["movieTitle"];
        $movie->time = $input["time"];
        $movie->date = $input["date"];
        $movie->type = $input["type"];
        $movie->save();
    }
    public function upd($request)
    {
        $input = $request->input();
        $movie = MovieDate::find($request->id);
        $movie->MovieId = $input["MovieId"];
        $movie->MovieName = $input["MovieName"];
        $movie->time = $input["time"];
        $movie->date = $input["date"];
        $movie->type = $input["type"];
        $movie->update();
    }
}
