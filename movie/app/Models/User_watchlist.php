<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User_watchlist extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_watchlist_id';

    protected $guarded = [''];

    public function movie(){
        return $this->belongsTo(Movie::class, 'movie_id', 'movie_id');
    }

    public function scopeSearch($query, $search)
    {
        $query->when($search ?? false, function($query, $search){
            return $query->whereHas('movie', function($query) use ($search){
                $query->where('title', $search);
            });
        });
    }

    public function scopeStatus($query, $search)
    {
        $query->when($search ?? false, function($query, $search){
            return $query->where('status', $search);
        });
        
    }
}
