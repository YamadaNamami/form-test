<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ConfirmController extends Controller
{
    public function store(Request $request){
        if($request->input('back') == 'back'){
            return redirect('/')
                        ->withInput();
        }

        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'category_id',
            'detail'
        ]);
        Contact::create($contact);
        return view('thanks');
    }
}
