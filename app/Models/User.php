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
    public function searchBookings($input)
    {
        return User::where('firstname', 'LIKE', '%' . $input->keyword . '%')->get();
    }
    public function soldSeats($movies,$reqDate,$reqTime)
    {
        return User::where('MovieId', $movies->movieTitle)->where('date',$reqDate)->where('time',$reqTime)->get();
    }
    public static function store($request)
    {
        $input = $request->input();
        $user = new User();
        $user->firstname = $input["firstname"];
        $user->lastname = $input["lastname"];
        $fullName = $user->firstname.' '.$user->lastname.' '.$user->created_at;
        $user->email = $input["email"];
        $user->date = $input["datte"];
        $user->time = $input["timee"];
        $user->ticknum = $input["ticknum"];
        $user->MovieId = $input["MovieId"];
        $email = $input["email"];
        $user->places = $input["places"];
        $reservation = 'Резервация за филма '.$user->MovieId.' на дата '.$user->date.' от '.$user->time.' Брой билети: '.$user->ticknum.' Места: '.$user->places;
        $data = array('name'=>$fullName,'comment' => $reservation);
        Mail::send(['text'=>'mail'], $data, function($message) use ($email) {
            $message->to($email, 'Tutorials Point')->subject
                ('Резервиране на билет за кино');
            $message->from('killaonthehilla@gmail.com','Кино');
        });
      echo "Basic Email Sent. Check your inbox.";
        $user->save();
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

?>