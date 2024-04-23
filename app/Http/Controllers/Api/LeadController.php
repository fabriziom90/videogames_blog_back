<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Models\Lead;
use App\Mail\NewContact;

class LeadController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'name'      => 'required|max:50',
            'surname'   => 'required|max:70',
            'email'     => 'required|max:100',
            'phone'     => 'required|max:20',
            'content'   => 'required'
        ], $errors = [
            'name.required' => 'Il nome è obbligatorio',
            'name.max'  => 'Il nome deve essere lungo al massimo 50 caratteri',
            'surname.required' => 'Il cognome è obbligatorio',
            'surname.max'  => 'Il cognome deve essere lungo al massimo 70 caratteri',
            'email.required' => 'L\'indirizzo email è obbligatorio',
            'email.max'  => 'L\'indirizzo email deve essere lungo al massimo 100 caratteri',
            'phone.required' => 'Il numero di telefono è obbligatorio',
            'phone.max'  => 'Il numero di telefono deve essere lungo al massimo 20 caratteri',
            'content.required' => 'Il messaggio è obbligatorio',
            // 'required' => 'Il campo :attribute è obbligatorio',
            // 'max'   => 'Il campo :attribute deve essere lungo al massimo :max caratteri'
        ]);

        //VERIFICO SE LA VALIDAZIONE FALLISCE
        if($validator->fails()){
            return response()->json([
                'success'   => false,
                'errors'    => $validator->errors()
            ]);
        }

        //SE LA VALIDAZIONE VA A BUON FINE DEVO CREARE UN NUOVO RECORD NELLA TABELLA LEAD
        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        //INVIO LA MAIL
        Mail::to('info@videogamesblog.com')->send(new NewContact($new_lead));

        return response()->json([
            'success'   => true
        ]);
        
    }
}
