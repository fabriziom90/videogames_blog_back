<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        
        return response()->json([
            'status' => true,
            'result' => $categories
        ]);
    }

    public function categories_homepage(){
        $categories =  Category::withCount('posts')->orderBy('posts_count', 'desc')->take(4)->get();

        return response()->json([
            'status' => true,
            'categories'    => $categories
        ]);
    }
}
