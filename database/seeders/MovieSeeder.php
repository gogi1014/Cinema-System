<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;
use App\Models\Movie;
use Illuminate\Support\Str;


class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cinema')->insert([
            'movieImg' => Str::random(10),
            'movieTitle' => Str::random(10),
            'movieGenre' => Str::random(10),
            'movieDirector' => Str::random(10),
            'movieDuration' => 100,
            'movieRelDate' =>  '2023-01-27',
            'movieActors' => Str::random(10),
            'Description' => Str::random(10),
            'movieCat' => Str::random(10),
            'movieLan' => Str::random(10),
            
        ]);
    }
}
