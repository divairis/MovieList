<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ActorSeeder::class,
            MovieSeeder::class,
            MovieActorSeeder::class,
            UserSeeder::class,
            UserWatchlistSeeder::class,
            UserGenreSeeder::class,
        ]);
    }
}
