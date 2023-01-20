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
        'created_at',
    ];

    public static function store($request)
    {
        $input = $request->input();
        $user = new User();
        $user->firstname = $input["firstname"];
        $user->lastname = $input["lastname"];
        $fullName = $user->firstname.' '.$user->lastname.' '.$user->created_at;
        $user->email = $input["email"];
        $user->date = User::get('date');
        $user->ticknum = $input["ticknum"];
        $user->time = $request->get('time');
        $user->MovieId = $input["MovieId"];
        $reservation = 'Резервация за филма '.$user->MovieId.' на дата '.$user->date.' от '.$user->time.'Брой билети'.$user->ticknum;
        $data = array('name'=>$fullName,'comment' => $reservation);
        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('gogi1014@gmail.com', 'Tutorials Point')->subject
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
