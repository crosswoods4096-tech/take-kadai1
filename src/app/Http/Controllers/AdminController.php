<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::with(['category', 'channels']);

        // 名前・メールアドレス（統合検索）
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('first_name', 'LIKE', "%{$keyword}%")
                    ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keyword}%"])
                    ->orWhere('email', 'LIKE', "%{$keyword}%");
            });
        }

        // 性別
        $query->when($request->gender, function ($q, $gender) {
            $q->where('gender', $gender);
        });

        // お問い合わせ種類
        $query->when($request->type, function ($q, $type) {
            $q->where('type', $type);
        });

        // 日付（created_at の日付一致）
        $query->when($request->date, function ($q, $date) {
            $q->whereDate('created_at', $date);
        });

        $contacts = $query->orderBy('id', 'desc')->paginate(10);

        // カテゴリが必要なら渡す
        $categories = Category::all();

        return view('admin.contacts.list', compact('contacts', 'categories'));
    }
}
