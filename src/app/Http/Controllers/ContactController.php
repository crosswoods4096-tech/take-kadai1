<?php

namespace App\Http\Controllers;

use App\Models\Channel;


use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Models\Category;


class ContactController extends Controller
{
  public function index()
  {
    $categories = Category::all();
    return view('contacts.index', compact('categories'));
  }

  public function confirm(ContactRequest $request)
  {
    // 入力値を取得
    $inputs = $request->all();

    // チャンネル情報の取得（既存処理）
    $selectedChannels = [];
    if ($request->filled('channels')) {
      $selectedChannels = Channel::whereIn('id', $request->channels)->get();
    }

    // 画像がアップロードされていたら保存
    if ($request->hasFile('image')) {
      // storage/app/public/images に保存される
      // ファイル名は自動でユニークな名前になる
      $path = $request->file('image')->store('images', 'public');

      // 確認画面で表示するためにパスを inputs に追加
      $inputs['image'] = $path;
    }


    return view('contacts.confirm', [
      'inputs'   => $inputs,
      'channels' => $selectedChannels,
    ]);
  }

  public function store(ContactRequest $request)
  {
    // 画像パス（confirm で保存したもの）を取得
    $imagePath = $request->image ?? null;

    // DB 登録
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
      'image'       => $imagePath,   // ← 画像パスを保存
    ]);

    // 中間テーブル（channels）登録
    if ($request->filled('channels')) {
      $contact->channels()->sync($request->channels);
    }

    return redirect()->route('thanks');
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
