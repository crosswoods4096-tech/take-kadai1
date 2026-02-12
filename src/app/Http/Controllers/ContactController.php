<?php

namespace App\Http\Controllers;

use App\Models\Channel;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Http\Requests\StoreContactRequest;

class ContactController extends Controller
{
  public function index()
  {
    $categories = Category::all();
    return view('index', compact('categories'));
  }

  public function confirm(ContactRequest $request)
  {
    $selectedChannels = [];

    if ($request->filled('channels')) {
      $selectedChannels = Channel::whereIn('id', $request->channels)->get();
    }

    return view('contacts.confirm', [
      'inputs'   => $request->all(),
      'channels' => $selectedChannels,
    ]);
  }

  public function store(ContactRequest $request)
  {
    $contact = Contact::create([
      'last_name'   => $request->last_name,
      'first_name'  => $request->first_name,
      'gender'      => $request->gender,
      'email'       => $request->email,
      'tel'         => $request->tel_1 . $request->tel_2 . $request->tel_3,
      'address'     => $request->address,
      'building'    => $request->building,
      'category_id' => $request->category_id,
      'content'     => $request->content,
    ]);

    if ($request->filled('channels')) {
      $contact->channels()->sync($request->channels);
    }

    return view('contacts.thanks');
  }
  
  // public function store(Request $request)
  // {
  //   $contact = [
  //     'last_name' => $request->last_name,
  //     'first_name' => $request->first_name,
  //     'gender' => $request->gender,
  //     'email' => $request->email,
  //     'tel' => $request->tel_1 . $request->tel_2 . $request->tel_3,
  //     'address' => $request->address,
  //     'building' => $request->building,
  //     'category_id' => $request->category_id,
  //     'content' => $request->content,
  //   ];


  //   Contact::create($contact);
  //   return view('thanks');
  // }
}
