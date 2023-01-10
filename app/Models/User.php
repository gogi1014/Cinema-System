<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';
    use HasFactory;
    public $fillable = [
        'id',
        'firstname',
        'lastname',
        'email',
        'date',
        'ticknum',
        'time',
        'MovieId',
    ];

    public static function store($request)
    {
        $input = $request->input();
        $user = new User();
        $user->firstname = $input["firstname"];
        $user->lastname = $input["lastname"];
        $user->email = $input["email"];
        $user->MovieId = $input["MovieId"];
        $user->save();
    }
    public function upd($request)
    {
        $input = $request->input();
        $movie = Movie::find($request->id);
        $movie->firstname = $input["firstname"];
        $movie->lastname = $input["lastname"];
        $movie->email = $input["email"];
        $movie->date = $input["date"];
        $movie->ticknum = $input["ticknum"];
        $movie->time = $input["time"];
        $movie->MovieId = $input["MovieId"];
        $movie->update();
    }
}
