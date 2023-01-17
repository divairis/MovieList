<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\carbon;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=6;$i++){  
            DB::table('actors')->insert(
                [
                    'name' => "Actor $i",
                    'gender' => $random = rand(0, 1) ? 'Male' : 'Female',
                    'biography' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique ipsamtempore eius?Numquam voluptas sunt maxime ullam ratione quam accusantium nostrum porro, beatae doloreslibero saepezmolestiae aut tenetur magnam!',
                    'dob' => '2022-12-21',
                    'pob' => Str::random(10),
                    'image_url' => 'https://picsum.photos/200',
                    'popularity' => rand(0, 100) / 10
                ]);
        }
    }
}
