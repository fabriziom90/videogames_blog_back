<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;
use App\Models\Tag;
use App\Models\ImageGalleryPost;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $data = $request->all();
        $type_view = $data['show_type'];
        
        $user = Auth::user();
        if($user->hasRole('admin')){
            $posts = Post::with(['user'])->get(); 
        }
        else{
            $posts = Post::where('user_id', $user->id)->orderByDesc('id')->get();
        }
        
        if($type_view == 0){
            return view('admin.posts.index', compact('posts'));
        }
        
        return view('admin.posts.index_card', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //POICHE' DEVO CICLARE LE CATEGORIE PRESENTI NELLA TABELLA ALL'INTERNO DELLA PAGINA DI CREAZIONE DI UN NUOVO POST, RECUPERO LE CATEGORIE E LE INVIO ALLA VIEW
        $categories = Category::all();

        //RECUPERO I TAG DA MOSTRARE NELLA VIEW PER CREARE LE VARIE CHECKBOX
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $form_data = $request->all();
        
        $post = new Post();
        
        //RECUPERO L'UTENTE ATTUALMENTE LOGGATO
        $user = Auth::user();

        //VERIFICO SE LA RICHIESTA CONTIENE IL CAMPO cover_image
        if($request->hasFile('cover_image')){

            //ESEGUO L'UPLOAD DEL FILE E RECUPERO IL PATH
            $path = Storage::disk('public')->put('posts_image', $form_data['cover_image']);
            $form_data['cover_image'] = $path; 
            //$post->cover_image = $path;
        }
        

        $slug = Post::generateSlug($form_data['title']);
        $form_data['slug'] = $slug;
        $form_data['user_id'] = $user->id;

        //SE L'UTENTE E' ADMIN IL POST E' AUTOMATICAMENTE APPROVATO ALTRIMENTI NO
        if($user->hasRole('admin')){
            $form_data['approved'] = true;
        }
        else{
            $form_data['approved'] = false;
        }

        // $post->category_id = $form_data['category_id'];
        $post->fill($form_data);

        $post->save();

        //VERIFICO DOPO AVER SALVATO IL POST (HO BISOGNO DEL SUO ID) SE SONO PRESENTI IMMAGINI DI GALLERIA
        if($request->has('gallery_images')){
            //LE RECUPERO E METTO IN UNA VARIABILE PER MIGLIORARE LA LEGGIBILITA'. NON E' OBBLIGATORIO
            $images = $form_data['gallery_images'];

            //CICLO LE IMMAGINI
            foreach($images as $image){
                //NE FACCIO L'UPLOAD
                $path = Storage::disk('public')->put('post_gallery_image', $image);
                
                //LE PREPARO PER ESERE INSERITI CON FILLABLE
                $data_image['post_id'] = $post->id;
                $data_image['path'] = $path;

                //CREO IL NUOVO RECORD
                $imageGallery = new ImageGalleryPost();
                $imageGallery->fill($data_image);

                $imageGallery->save();
            }
        }

        if($request->has('tags')){
            $post->tags()->attach($form_data['tags']);
        }

        $show_type = 0;

        return redirect()->route('admin.posts.index', compact('show_type'))->with('message', 'Post creato correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {      
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Request $request)
    {   
        $error_message = '';
        if(!empty($request->all())){
            $messages = $request->all();
            $error_message = $messages['error_message'];
        }

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'error_message', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $form_data = $request->all();
        
        $user = Auth::user();
        
        $exists = Post::where('title', 'LIKE', $form_data['title'])
        ->where('id', '!=', $post->id)
        ->get();
        
        if(count($exists) > 0){
            $error_message = 'Hai inserito un titolo già presente in un altro articolo';
            return redirect()->route('admin.posts.edit', compact('post', 'error_message'));
        }

        if($request->hasFile('cover_image')){
            //SE IL POST HA UN'IMMAGINE
            if($post->cover_image != null){
                Storage::disk('public')->delete($post->cover_image);
            }
            
            $path = Storage::disk('public')->put('posts_image', $form_data['cover_image']);
            $form_data['cover_image'] = $path;  
        }

        //VERIFICO DOPO AVER SALVATO IL POST (HO BISOGNO DEL SUO ID) SE SONO PRESENTI IMMAGINI DI GALLERIA
        if($request->has('gallery_images')){
            //LE RECUPERO E METTO IN UNA VARIABILE PER MIGLIORARE LA LEGGIBILITA'. NON E' OBBLIGATORIO
            $images = $form_data['gallery_images'];

            //CICLO LE IMMAGINI
            foreach($images as $image){
                //NE FACCIO L'UPLOAD
                $path = Storage::disk('public')->put('post_gallery_image', $image);
                
                //LE PREPARO PER ESERE INSERITI CON FILLABLE
                $data_image['post_id'] = $post->id;
                $data_image['path'] = $path;

                //CREO IL NUOVO RECORD
                $imageGallery = new ImageGalleryPost();
                $imageGallery->fill($data_image);

                $imageGallery->save();
            }
        }

        $form_data['slug'] = Str::slug($form_data['title'], '-');
        $form_data['user_id'] = $user->id;
        
        //SE L'UTENTE E' ADMIN IL POST E' AUTOMATICAMENTE APPROVATO ALTRIMENTI NO
        if($user->hasRole('admin')){
            $form_data['approved'] = true;
        }
        else{
            $form_data['approved'] = false;
        }

        $post->update($form_data);

        if($request->has('tags')){
            $post->tags()->sync($form_data['tags']);
        }
        else{
            $post->tags()->sync([]);
        }

        $show_type = 0;

        return redirect()->route('admin.posts.index', compact('show_type'))->with('message', 'Post modificato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {   
        //$post->tags()->sync([]); //CANCELLAZIONE MANUALE DEI RECORD NELLA TABELLA PONTE PRIMA DI ELIMINARE IL POST

        if($post->cover_image != null){
            Storage::disk('public')->delete($post->cover_image);
        }

        foreach($post->image_gallery_post as $image){
            Storage::disk('public')->delete($image->path);

            $image->delete();
        }

        $show_type = 0;

        $post->delete();
        return redirect()->route('admin.posts.index', compact('show_type'))->with('message', 'Post cancellato correttamente');
    }

    public function edit_status(Request $request, Post $post){
        $form_data = $request->all();

        $post->approved = $form_data['approved'];

        $post->update();

        if($form_data['approved'] == 0){
            $message = 'Il post è in approvazione';
        }
        elseif($form_data['approved'] == 1){
            $message = 'Il post è stato approvato';
        }
        else{
            $message = 'Il post non è stato approvato';
        }

        //INVIO EMAIL ALL'UTENTE DOPO IL CAMBIO DI STATO


        return redirect()->route('admin.posts.show', $post->id)->with('message', $message);
    }
}
