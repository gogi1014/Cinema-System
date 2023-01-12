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
    ];

    public static function store($request)
    {
        $input = $request->input();
        $user = new User();
        $user->firstname = $input["firstname"];
        $user->lastname = $input["lastname"];
        $fullName = $user->firstname.' '.$user->lastname;
        $user->email = $input["email"];
        $user->date = $input["date"];
        $user->ticknum = $input["ticknum"];
        $user->time = $input["time"];
        $user->MovieId = $input["MovieId"];
        $data = array('name'=>$fullName,'comment' => 'test message');
        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('gogi1014@gmail.com', 'Tutorials Point')->subject
                ('Laravel Basic Testing Mail');
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
        $movie->date = $input["date"];
        $movie->ticknum = $input["ticknum"];
        $movie->time = $input["time"];
        $movie->MovieId = $input["MovieId"];
        $movie->update();
    }
}
