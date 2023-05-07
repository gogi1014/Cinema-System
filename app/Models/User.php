<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Mail;

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
        'places',
        'created_at',
    ];
    public function searchBookings($request)
    {
        if ($request->searchDateModel != 'default') {
            if ($request->searchTimeModel != 'default') {
                return User::where('time', 'LIKE', '%' . $request->searchTimeModel . '%')->where('date', 'LIKE', '%' . $request->searchDateModel . '%')->get();
            } else {
                return User::where('date', 'LIKE', '%' . $request->searchDateModel . '%')->get();
            }
        }
        if ($request->searchModel == 'movieTitle') {
            return User::where('MovieId', 'LIKE', '%' . $request->keyword . '%')->get();
        }
        if ($request->searchModel == 'id') {
            return User::where('id', 'LIKE', '%' . $request->keyword . '%')->get();
        } else {
            return User::where('firstname', 'LIKE', '%' . $request->keyword . '%')->orWhere('lastname', 'LIKE', '%' . $request->keyword . '%')->get();
        }
    }
    public function soldSeats($movies, $reqDate, $reqTime)
    {
        return User::where('MovieId', $movies->movieTitle)->where('date', $reqDate)->where('time', $reqTime)->get();
    }
    public static function store($request)
    {
        $input = $request->input();
        $user = new User();
        $user->firstname = $input["firstname"];
        $user->lastname = $input["lastname"];
        $fullName = $user->firstname . ' ' . $user->lastname . ' ' . $user->created_at;
        $user->email = $input["email"];
        $user->date = $input["datte"];
        $user->time = $input["timee"];
        $user->ticknum = $input["ticknum"];
        $user->MovieId = $input["MovieId"];
        $email = $input["email"];
        $user->places = $input["places"];
        $user->save();
        $full = $user->firstname . " " . $user->lastname;
        $ticked_id = User::where("email",$user->email)->where("date",$user->date)->where("time",$user->time)->where("MovieId",$user->MovieId)->where("places",$user->places)->pluck('id');
        $data = array(
            'name' => $fullName, 'movieName' => $user->MovieId, 'full' => $full,
            'date' => $user->date, 'time' => $user->time, 'ticknum' => $user->ticknum, 'places' => $user->places, 'ticked_id' => $ticked_id);
        Mail::send('mail', $data, function ($message) use ($email) {
            $message->to($email, 'Tutorials Point')->subject('Резервиране на билет за кино');
            $message->from('killaonthehilla@gmail.com', 'Кино');
        });
    }
    public function upd($request)
    {
        $input = $request->input();
        $movie = User::find($request->id);
        $movie->firstname = $input["firstname"];
        $movie->lastname = $input["lastname"];
        $movie->email = $input["email"];
        $movie->date = $request->date;
        $movie->ticknum = $input["ticknum"];
        $movie->time = $request->time;
        $movie->MovieId = $input["MovieId"];
        $movie->update();
    }
}
