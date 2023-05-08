<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Actor;
use App\Models\User;
use App\Models\Entities;
use App\Models\EntityGenres;
use App\Models\MovieActors;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\MovieResource;

class MovieController extends Controller
{
    public $entity_type = 'movies';
    protected $genres;
    protected $actors;
    protected $movies;

    public function __construct(){
      //getiing genres and actors details
        $this->genres = Genre::all();
        $this->actors = Actor::all();
    }

    //-------GET End point------------------
    public function index(Request $request)
    {
      $genreString = null;
      $actorString = null;
      // convering genres array into string to pass it to stored procedure
      if ($request->has('genres')) {
            $genreString = implode(', ', $request->input('genres'));
      }
      // convering genres array into string to pass it to stored procedure
      if ($request->has('actors')) {
            $actorString = implode(', ', $request->input('actors'));
       }

       //getting all the movies from database
       $movies = DB::SELECT('call get_movies(? ,? , ?)', [$request->input('release_date'),$genreString, $actorString]);

       return MovieResource::collection($movies);
    }
    //function to show data on browser
    public function movie_list(Request $request)
    {
      $genreString = null;
      $actorString = null;
      // convering genres array into string to pass it to stored procedure
      if ($request->has('genres')) {
            $genreString = implode(', ', $request->input('genres'));
      }
      // convering genres array into string to pass it to stored procedure
      if ($request->has('actors')) {
            $actorString = implode(', ', $request->input('actors'));
       }

      //getting all the movies from database
      $this->movies = DB::SELECT('call get_movies(? ,? , ?)', [$request->input('release_date'),$genreString, $actorString]);

      return view("movie_view", ["genres"=>$this->genres,
                                 "actors"=>$this->actors,
                                 "movies"=>$this->movies
                                ]);
    }

    //function to insert data into database
    //------------POST End Point-------------
    public function store(Request $request)
    {
      $genres = [];
      $actors = [];
      $movie = Movie::create([
            'name' => $request->input('name'),
            'user_id' => $request->input('user_id'),
            'description' => $request->input('description'),
            'image' => $request->file('image'),
            'release_date' => $request->input('release_date'),
            'rating' => $request->input('rating'),
            'award_winning' => $request->input('award_winning') == 'on' ? 1 : 0,
            'user_id'=> 1
        ]);
        if ($request->has('genres')) {
            $entity_type_id =Entities::where('entityType', $this->entity_type)->value('id');
            foreach($request->input('genres') as $genre) {
                $genres[] = ['genre_id' => $genre,
                           'entity_type_id'=> $entity_type_id,
                           'entity_id' => $movie->id];
            }
            //dd($genres);
            EntityGenres::insert($genres);
        }

        if ($request->has('actors')) {
          foreach($request->input('actors') as $actor) {
              $actors[] = ['actor_id' => $actor,
                          'movie_id' => $movie->id];
          }
           MovieActors::insert($actors);
        }
        return response()->json($movie);
    }
    // function to get data for create view
    public function create()
    {
      return view("movie_create", ["genres"=>$this->genres,
                                   "actors"=>$this->actors
                                  ]);
    }
    // function to find movie
    public function show(Movie $movie)
    {
      return MovieResource::collection($movie);
    }


}
