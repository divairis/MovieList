<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Movie;
use App\Models\Movie_actor;
use App\Models\Movie_genre;
use Illuminate\Http\Request;
use App\Models\User_watchlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd(Cookie::get());
        $user_watchlist_movie = [];
        $random_movies = Movie::with('genre')->inRandomOrder()
        ->take(3)->get();

        $popular_movies = User_watchlist::with('movie')
        ->selectRaw('count(movie_id) as count, movie_id')
        ->groupBy('movie_id')->take(6)
        ->orderByDesc('count')
        ->get();

        if($request->category){
            $movies = Movie::orderBy('movie_id', 'DESC')->category($request->category)->get();
        }else{
            $movies = Movie::orderBy('movie_id', 'DESC')->search($request->s)->get();
        }

        $genres = collect(["Adventure", "Drama", "Comedy", "Thriller", "Sci-fi", "Fantasy", "Romance"]);

        if(Auth::check()){
            $user_id = Auth::user()->user_id;
            $user_movie = User_watchlist::where('user_id', $user_id)->get();
                foreach ($user_movie as $user_movie_id) {
                    array_push($user_watchlist_movie, $user_movie_id->movie_id);
            }
        }

        $data = [
            "random_movies" => $random_movies,
            "popular_movies" => $popular_movies,
            "movies" => $movies,
            "genres" => $genres,
            "user_watchlist" => $user_watchlist_movie
        ];

        return view('movie.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = collect(["Adventure", "Drama", "Comedy", "Thriller", "Sci-fi", "Fantasy", "Romance"]);
        $actors = Actor::all();
        

        return view('movie.add', ['genres' => $genres, 'actors' => $actors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovieRequest $request)
    {   
        $count_actor = count($request->actor);
        $data_movie = [
            'title' => $request->title,
            'description' => $request->description,
            'biography' => $request->biography,
            'director' => $request->director,
            'release_date' => $request->release_date,
            'image_url' => $request->file('image')->store('movie-picture'),
            'background' => $request->file('background')->store('background-movie-picture'),
        ];

        $new_movie = Movie::create($data_movie);

        $new_movie_genre = [];
        $count_genre = count($request->genre);
        for ($i = 0; $i < $count_genre; $i++){
            $genre_arr = [
                'movie_id' => $new_movie->movie_id,
                'name' => $request->genre[$i]
            ];

            array_push($new_movie_genre, $genre_arr);
        }

        Movie_genre::insert($new_movie_genre);

        $new_movie_actor = [];
        $count_actor = count($request->actor);
        for ($i = 1; $i < $count_actor; $i++){ 
            $actor_arr=[ 
                'movie_id'=> $new_movie->movie_id,
                'actor_id' => $request->actor[$i],
                'character_name' => $request->character_name[$i]
            ];

            array_push($new_movie_actor, $actor_arr);
        }

        Movie_actor::insert($new_movie_actor);

        return redirect()->route('home');
    }

    public function show($movie_id)
    {
        $user_watchlist_movie = [];
        $movie = Movie::with('genre', 'Movie_actor.actor')->find($movie_id);
        $random_movies = Movie::with('genre')->where('movie_id', '!=', $movie_id)
        ->inRandomOrder()->take(4)->get();
        if(Auth::check()){
            $user_id = Auth::user()->user_id;
            $user_movie = User_watchlist::where('user_id', $user_id)->get();
            foreach ($user_movie as $user_movie_id) {
                array_push($user_watchlist_movie, $user_movie_id->movie_id);
            }
        }

        $data = [
            'movie' => $movie, 
            'random_movies' => $random_movies,
            "user_watchlist" =>$user_watchlist_movie
        ];

        return view('movie.detail', $data);
    }

    public function edit($movie_id)
    {
        $movie = Movie::with('genre', 'movie_actor.actor')->find($movie_id);
        $actors = Actor::all();

        $old_movie_actor_id = [];
        foreach ($movie->movie_actor as $actor) {
            $actor_arr_id = $actor->actor_id;
            array_push($old_movie_actor_id, $actor_arr_id);
        }

        $old_movie_actor_name = [];
        foreach ($movie->movie_actor as $actor) {
            $actor_arr_name = $actor->character_name;
            array_push($old_movie_actor_name, $actor_arr_name);
        }

        $old_movie_genre = [];
        foreach ($movie->genre as $genre) {
            $genre_arr = $genre->name;
            array_push($old_movie_genre, $genre_arr);
        }

        $genres = collect(["Adventure", "Drama", "Comedy", "Thriller", "Sci-fi", "Fantasy", "Romance"]);


        $data = [
            'movie' => $movie,
            'genres' => $genres, 
            'actors' => $actors,
            'old_movie_genre' => $old_movie_genre,
            'old_movie_actor_id' => $old_movie_actor_id,
            'old_movie_actor_name' => $old_movie_actor_name,
        ];

        return view('movie.edit', $data);
    }

    public function update(UpdateMovieRequest $request)
    {
        $movie_id = $request->movie_id;
        Movie_genre::where('movie_id', $movie_id)->delete();
        Movie_actor::where('movie_id', $movie_id)->delete();
        $movie = Movie::find($movie_id);

        $count_actor = count($request->actor);
        $data_movie = [
            'title' => $request->title,
            'description' => $request->description,
            'biography' => $request->biography,
            'director' => $request->director,
            'release_date' => $request->release_date,
            'image_url' => $request->file('image')->store('movie-picture'),
            'background' => $request->file('background')->store('background-movie-picture'),
        ];
        if(file_exists(public_path("storage/$movie->image_url"))){
            Storage::delete($movie->image_url);
        }

        if(file_exists(public_path("storage/$movie->background"))){
            Storage::delete($movie->background);
        }
        $movie->update($data_movie);

        $new_movie_genre = [];
        $count_genre = count($request->genre);
        for ($i = 0; $i < $count_genre; $i++){ 
            $genre_arr=
            [ 
                'movie_id'=> $movie->movie_id,
                'name' => $request->genre[$i]
            ];
            array_push($new_movie_genre, $genre_arr);
        }
        Movie_genre::insert($new_movie_genre);

        $new_movie_actor = [];
        $count_actor = count($request->actor);
        for ($i = 1; $i < $count_actor; $i++){ 
            $actor_arr=
            [ 
                'movie_id'=> $movie->movie_id,
                'actor_id' => $request->actor[$i],
                'character_name' => $request->character_name[$i]
            ];
            array_push($new_movie_actor, $actor_arr);
        }

        Movie_actor::insert($new_movie_actor);

        return redirect()->route('movie_detail', $movie->movie_id);
    }

    public function destroy($movie_id)
    {
        $movie = Movie::find($movie_id);
        if(file_exists(public_path("storage/$movie->image_url"))){
            Storage::delete($movie->image_url);
        }

        if(file_exists(public_path("storage/$movie->background"))){
            Storage::delete($movie->background);
        }

        $movie->destroy($movie->movie_id);

        return redirect()->route('home');
    }
}
