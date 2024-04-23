<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:150|unique:posts',
            'category_id' => 'nullable|exists:categories,id',
            'cover_image' => 'nullable|image|max:4084',
            'content' => 'required'
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Il titolo del post è obbligatorio',
            'title.max'     => 'Il titolo del posto deve essere lungo al massimo 150 caratteri',
            'title.unique'  => 'E\' già presente un post con questo titolo',
            'category_id.exists'    => 'La categoria selezionata non esiste.',
            'cover_image.image' => 'Il file selezionato deve essere una immagine',
            'cover_image.size'  => 'Il file selezionato deve essere grande al massimo 1024 Kb',
            'content.requried'  => 'Il contenuto del post è obbligatorio'
        ]; 
    }
}
