<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $form_data = $request->all();

        $category = new Category();

        $form_data['slug'] = Str::slug($form_data['name'], '-');

        if($request->hasFile('cover_image')){
            //ESEGUO L'UPLOAD DEL FILE E RECUPERO IL PATH
            $path = Storage::disk('public')->put('categories_image', $form_data['cover_image']);
            $form_data['cover_image'] = $path; 
            //$post->cover_image = $path;
        }

        $category->fill($form_data);

        $category->save();

        return redirect()->route('admin.categories.index')->with('message', 'Categoria salvata correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $form_data = $request->all();

        $form_data['slug'] = Str::slug($form_data['name'], '-');

        if($request->hasFile('cover_image')){
            //SE IL POST HA UN'IMMAGINE
            if($category->cover_image != null){
                Storage::disk('public')->delete($category->cover_image);
            }
            
            $path = Storage::disk('public')->put('categories_image', $form_data['cover_image']);
            $form_data['cover_image'] = $path;  
        }

        $category->update($form_data);

        return redirect()->route('admin.categories.index')->with('message', 'Categoria modificata correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {   
        $category->delete();

        return redirect()->route('admin.categories.index')->with('message', 'Hai cancellato correttamente la categoria');
    }
}
