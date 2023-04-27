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
        'active',
        'sim',
    ];

    public function searchMovies($request)
    {
        if($request->categorySelect != 'default'){
            return Movie::where('movieCat', 'LIKE', '%' . $request->categorySelect . '%')->get();
        }
        if($request->genreSelect != 'default'){
            return Movie::where('movieGenre', 'LIKE', '%' . $request->genreSelect . '%')->get();
        }
        if ($request->searchModel == 'movieTitle') {
            return Movie::where('movieTitle', 'LIKE', '%' . $request->keyword . '%')->get();
        } 
        elseif($request->searchModel == 'movieId') {
            return Movie::where('movieId', 'LIKE', '%' . $request->keyword . '%')->get();
        }
    }
    public function getAllMovies()
    {
        return Movie::get()->unique('movieCat');
    }
    public function getMovies($input, $request)
    {
        $pagg = 5;
        $search = Movie::orderBy("sim","desc");
        if (isset($input['search'])) {
            $search->where('movieTitle', 'LIKE', "%" . $input["search"] . "%");
        }
        if (isset($input['category'])) {
            $search->where('movieCat', 'LIKE', $input["category"]);
        }
        /*if (isset($input['genres'])) {
            $search->where('movieGenre', 'LIKE', "%" . $input["genres"] . "%");
        }*/
        if (request()->genres) {
            $genres = array_unique(array_keys(request()->genres));
            $impGenres = implode(" ", $genres);
            $arr = array();
            foreach ($genres as $genre) {
                $aa = ($search->orWhere('movieGenre', 'LIKE', "%" . $genre . "%")->pluck('movieGenre'))->toArray();
            }            
            for ($i = 0; $i < count($aa); $i++) {
                $expSort = explode(", ",$aa[$i]);
                sort($expSort);
                $impSort = implode(" ",$expSort);
                $newImpArr[$i] = $impSort;
                similar_text($newImpArr[$i], $impGenres, $perc);
                array_push($arr,$perc);
                Movie::where('movieGenre',$aa[$i])->update(["sim"=>$arr[$i]]);
            }
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
        $client = Movie::all()->pluck('movieGenre')->toArray();
        $client2 = implode(", ",  $client);
        $data = explode(", ", $client2);
        sort($data);
        return array_unique($data);
    }
}
