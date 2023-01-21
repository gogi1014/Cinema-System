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
    ];
    public static function store($request)
    {
        $input = $request->input();
        $movie = new MovieDate();
        $movie->MovieId = $input["MovieId"];
        $movie->MovieName = $input["MovieName"];
        $movie->time = $input["time"];
        $movie->date = $input["date"];
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
        $movie->update();
    }
 
}