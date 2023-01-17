<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genre = ["","Adventure", "Drama", "Comedy", "Thriller", "Sci-fi", "Fantasy", "Romance"];
        for($i=1;$i<=7;$i++){ 
            DB::table('movie_genres')->insert(
            [
                'movie_id' => rand(1,6),
                'name' => $genre[$i],
            ]);
        }
    }
}
