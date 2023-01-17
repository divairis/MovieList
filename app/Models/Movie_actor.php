<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_actor extends Model
{
    use HasFactory;

    protected $primaryKey = 'movie_actor_id';

    protected $guarded = [''];

    public function actor(){
        return $this->hasOne(Actor::class, 'actor_id', 'actor_id');
    }
}
