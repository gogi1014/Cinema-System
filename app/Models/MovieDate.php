<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieDate extends Model
{
    protected $table = 'moviedates';
    protected $primaryKey = 'id';
    use HasFactory;
    public $fillable = [
        'movieId',
        'date',
        'time',
    ];

 
}