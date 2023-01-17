<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $primaryKey = 'actor_id';

    protected $guarded = [''];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_actors', 'actor_id', 'movie_id');
    }

    public function scopeSearch($query, $search)
    {
        $query->when($search ?? false, function($query, $search){
            return $query->where('name', 'like', "%$search%");  
        });
    }

}
