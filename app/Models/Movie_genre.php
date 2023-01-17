<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_genre extends Model
{
    use HasFactory;

    protected $primaryKey = 'movie_genre_id';
    
    protected $guarded = [''];
}
