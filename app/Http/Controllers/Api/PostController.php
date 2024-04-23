<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Post;

class PostController extends Controller
{
    public function index(){

        // $posts = Post::all(); //RECUPERO TUTTI I POST
        // $posts = Post::paginate(6); //RECUPERO I POST SUDDIVISI PER PAGINA. IN QUESTO CASO SUDDIVIDE I POST IN 6 PER PAGINA
        $posts = Post::with(['category', 'tags', 'image_gallery_post'])->where('approved', 1)->orderBy('id', 'desc')->paginate(12); //RECUPERO I POST CON I DATI RELATIVI ALLA CATEGORIA DI APPERTENENZA ED AI TAGS PAGINANDOLI

        return response()->json([
            'success' => true,
            'results' => $posts
        ]);
    }

    public function get_category_posts($slug){
        // $posts = DB::table('posts')
        //     ->join('categories', 'posts.category_id', '=', 'categories.id') //IMPOSTO LA RELAZIONE CON CATEGORIES
        //     ->join('post_tag', 'post_tag.post_id' , '=', 'posts.id')
        //     ->join('tags', 'tags.id', '=', 'post_tag.tag_id')
        //     ->select('posts.title as postTitle', 'posts.slug as postSlug, posts.cover_image as postImage', 'categories.name as categoryName', 'categories.slug as categorySlug', 'tags.name as tagName', 'tags.slug as tagSlug')
        // ->where('categories.categorySlug', $slug)
        //     ->paginate(3);
        $posts = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id') //IMPOSTO LA RELAZIONE CON CATEGORIES
            ->select('posts.*', 'categories.slug as categorySlug')
            ->where('categories.slug', $slug)
            ->paginate(12);
        
        return response()->json([
            'success' => true,
            'results'   => $posts
        ]);
    }

    public function get_lasts_posts(){
        $posts = Post::with('category')->orderBy('id', 'desc')->where('approved',1)->take(6)->get();
        
        return response()->json([
            'success'   => true,
            'posts'     => $posts
        ]);
    }

    public function show($slug)
    {   
        //RECUPERIAMO IL POST ATTRAVERSO LO SLUG
        $post = Post::with('category', 'tags', 'image_gallery_post')->where('slug', $slug)->first();

        //VERIFICO CHE POST NON SIA NULL
        if($post){
            return response()->json([
                'success' => true,
                'post'  => $post
            ]);
        }
        
        return response()->json([
            'success' => false,
        ]);
        
    }


}
