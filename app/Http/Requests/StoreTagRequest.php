<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
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
            'name' => 'required|max:50',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Inserire il nome della categoria',
            'name.max'  => 'Il nome della categoria deve essere lungo al massimo 50 caratteri',
        ];
    }
}
