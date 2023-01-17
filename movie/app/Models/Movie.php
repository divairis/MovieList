<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $primaryKey = 'movie_id';

    protected $dates = ['release_date'];

    protected $guarded = [''];

    public function genre(){
        return $this->hasMany(Movie_genre::class, 'movie_id', 'movie_id');
    }

    public function movie_actor(){
        return $this->hasMany(Movie_actor::class, 'movie_id', 'movie_id');
    }

    public function scopeSearch($query, $search)
    {
        $query->when($search ?? false, function($query, $search){
            switch ($search) {
                case $search == "!A-Z!":
                    $return = $query->orderBy('title', 'ASC');
                    break;
                case "!Z-A!":
                    $return = $query->orderBy('title', 'DESC');
                    break;
                case $search!=null :
                    $return = $query->where('title', 'like', "%$search%");
                    break;
                default:
                    $return = $query->orderBy('movie_id', 'DESC');
                    break;
            }

            return $return;
        });
    }

        public function scopeCategory($query, $search)
        {
            $query->when($search ?? false, function($query, $search){
                return $query->whereHas('genre', function($query) use ($search){
                    $query->where('name', $search);
                });
            });
        }
}
