<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
  public function index()
  {
    return view('index');
  }
  public function confirm(ContactRequest $request)
  {
    $contact = new Contact($request->all());
    return view('confirm', compact('contact'));
  }
  public function store(ContactRequest $request)
  {
    $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel_1', 'tel_2', 'tel_3', 'address', 'building', 'kind', 'content']);
    Contact::create($contact);
    return view('thanks');
  }
}
