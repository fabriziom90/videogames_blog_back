<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use Faker\Generator as Faker;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0; $i<25; $i++){
            $post = new Post();
            $post->title = $faker->words(3, true);
            $post->content = $faker->text(500);
            $post->slug = Str::slug($post->title, '-');
            
            $post->save();
        }
    }
}
