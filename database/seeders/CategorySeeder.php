<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        $categories = [
            'RPG',
            'RTS',
            'Stealth',
            'FPS',
            'Azione',
            'Guida'
        ];

        foreach($categories as $category_name){
            $category = new Category();
            $category->name = $category_name;
            
            $category->slug = Str::slug($category_name, '-');

            $category->save();
        }
    }
}
