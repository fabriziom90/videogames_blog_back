<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tag;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $array = [
            'PC',
            'Playstation',
            'Xbox',
            'Retrogame',
            'Gamer',
            'Videogame',
        ];

        foreach($array as $item){
            $tag = new Tag();

            $tag->name = $item;
            $tag->slug = Str::slug($item, '-');

            $tag->save();
        }
    }
}
