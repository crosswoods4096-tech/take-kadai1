<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Models\Category;

class ContactController extends Controller
{
  public function index()
  {
    $categories = Category::all();
    return view('index', compact('categories'));
  }

  public function confirm(ContactRequest $request)
  {
    $contact = new Contact($request->all());
    // dd($contact);
    $category = Category::find($request->category_id);
    return view('confirm', compact('contact', 'category'));
  }

  public function store(Request $request)
  {

    // $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel_1', 'tel_2', 'tel_3', 'address', 'building', 'category_id', 'content']);
    $contact = [
      'last_name' => $request->last_name,
      'first_name' => $request->first_name,
      'gender' => $request->gender,
      'email' => $request->email,
      'tel' => $request->tel_1 . $request->tel_2 . $request->tel_3,
      'address' => $request->address,
      'building' => $request->building,
      'category_id' => $request->category_id,
      'content' => $request->content,
    ];


    Contact::create($contact);
    return view('thanks');
  }
}
