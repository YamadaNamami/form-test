<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;

class AdminController extends Controller
{
    public function index(){
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();
        return view('admin',compact('contacts','categories'));
    }

    public function search(Request $request){
        $contacts = Contact::with('category')->KeywordSearch($request->keyword)->GenderSearch($request->gender)->CategorySearch($request->category_id)->DateSearch($request->created_at)->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }
}
