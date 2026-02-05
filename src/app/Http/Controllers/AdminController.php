<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Admin;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::paginate(10);
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }
}
