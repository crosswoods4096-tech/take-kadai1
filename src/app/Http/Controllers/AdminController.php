<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        // 名前（姓・名・フルネーム・部分一致）
        if ($request->filled('name')) {
            $name = $request->name;

            $query->where(function ($q) use ($name) {
                $q->where('last_name', 'LIKE', "%{$name}%")
                    ->orWhere('first_name', 'LIKE', "%{$name}%")
                    ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$name}%"]);
            });
        }

        // 性別
        $query->when($request->gender, function ($q, $gender) {
            $q->where('gender', $gender);
        });

        // メールアドレス（部分一致）
        $query->when($request->email, function ($q, $email) {
            $q->where('email', 'LIKE', "%{$email}%");
        });

        // お問い合わせ種類
        $query->when($request->type, function ($q, $type) {
            $q->where('type', $type);
        });

        // 内容（単語ごと AND 検索）
        if ($request->filled('content')) {
            $words = preg_split('/\s+/u', $request->content);

            $query->where(function ($q) use ($words) {
                foreach ($words as $word) {
                    $q->where('content', 'LIKE', "%{$word}%");
                }
            });
        }

        // 日付（created_at の日付一致）
        $query->when($request->date, function ($q, $date) {
            $q->whereDate('created_at', $date);
        });

        $contacts = $query->orderBy('id', 'desc')->paginate(10);

        // カテゴリが必要なら渡す
        $categories = Category::all();

        return view('admin.contacts.index', compact('contacts', 'categories'));
    }
}
