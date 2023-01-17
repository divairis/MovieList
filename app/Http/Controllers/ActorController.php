<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreActorRequest;
use App\Http\Requests\UpdateActorRequest;

class ActorController extends Controller
{
    public function index(Request $request)
    {
        $actors = Actor::with('movies')->search($request->s)->get();
        return view('actor.index', ['actors' => $actors]);
    }

    public function create()
    {
        return view('actor.add');
    }

    public function store(StoreActorRequest $request)
    {
        $data = [
            'name' => $request->name,
            'gender' => $request->gender,
            'biography' => $request->biography,
            'dob' => $request->dob,
            'pob' => $request->pob,
            'image_url' => $request->file('image')->store('actor-picture'),
            'popularity' => $request->popularity,
        ];

        Actor::create($data);

        return redirect()->route('actor');
    }

    public function show($actor_id)
    {
        $actor = Actor::with('movies')->where('actor_id', $actor_id)->first();

        return view('actor.detail', ['actor' => $actor]);
    }

    public function edit($actor_id)
    {
        $actor = Actor::find($actor_id);
        
        return view('actor.edit', ['actor' => $actor]);
    }

    public function update(UpdateActorRequest $request)
    {
        $actor = Actor::find($request->actor_id);
        $newActor = [
            'name' => $request->name,
            'gender' => $request->gender,
            'biography' => $request->biography,
            'dob' => $request->dob,
            'pob' => $request->pob,
            'image_url' => $request->file('image')->store('actor-picture'),
            'popularity' => $request->popularity,
        ];

        if(file_exists(public_path("storage/$actor->image_url"))){
            Storage::delete($actor->image_url);
        }

        $actor->update($newActor);
        
        return redirect()->route('actor', $request->actor_id);
    }

    public function destroy($actor_id)
    {
        $actor = Actor::find($actor_id);
        
        if(file_exists(public_path("storage/$actor->image_url"))){
            Storage::delete($actor->image_url);
        }

        $actor->destroy($actor->actor_id);
        
        return redirect()->route('actor');
    }
}
