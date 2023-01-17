<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=6;$i++){ 
            DB::table('movie_actors')->insert(
            [
                'movie_id' => rand(1,6),
                'actor_id' => rand(1,6),
                'character_name' => "Character name $i",
            ]);
        }
    }
}
