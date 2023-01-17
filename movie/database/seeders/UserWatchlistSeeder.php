<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserWatchlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=6;$i++){ 
            DB::table('user_watchlists')->insert(
                [
                    'user_id' => rand(3,8),
                    'movie_id' => rand(1,6),
                    'status' => "Finished",
                ]);
        }
    }
}
