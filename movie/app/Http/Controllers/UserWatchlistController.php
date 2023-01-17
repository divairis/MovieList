<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_watchlist;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUser_watchlistRequest;
use App\Http\Requests\UpdateUser_watchlistRequest;

class UserWatchlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user()->user_id;
        $data = User_watchlist::with('movie')->search($request->s)->status($request->status)->where('user_id', $user)->paginate(4);

        return view('user_watchlist.index', ['data' => $data]);
    }

    public function status(Request $request)
    {
        $data = ["status"=>$request->status];
        User_watchlist::find($request->user_watchlist_id)->update($data);

        return redirect()->route('user_watchlist');
    }

    public function store($movie_id)
    {
        $data = [
            "user_id" => Auth::user()->user_id,
            "movie_id" => $movie_id,
            "status" => "Planned"
        ];

        User_watchlist::create($data);

        return redirect()->route('user_watchlist');
    }

    public function destroy($user_watchlist_id)
    {
        User_watchlist::destroy($user_watchlist_id);

        return redirect()->route('user_watchlist');
    }
}
