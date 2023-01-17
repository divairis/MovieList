<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=6;$i++){ 
            DB::table('movies')->insert(
            [
                'title' => "Movie Title $i",
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique ipsamtempore
                eius?Numquam voluptas sunt maxime ullam ratione quam accusantium nostrum porro, beatae doloreslibero
                saepezmolestiae aut tenetur magnam!',
                'director' => "Director $i",
                'release_date' => "2022-12-23",
                'image_url' => 'https://picsum.photos/200',
                'background' => 'https://picsum.photos/200',
            ]);
        }
    }
}
