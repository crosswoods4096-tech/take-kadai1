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
    public function images()
    {
        // Contact モデルの image カラムから画像一覧を取得
        $images = Contact::whereNotNull('image')->orderBy('id', 'desc')->get();

        return view('admin.images.index', compact('images'));
    }
    public function imageDetail($id)
    {
        // Contact モデルから該当データを取得
        $contact = Contact::with('channels')->findOrFail($id);

        return view('admin.image-detail', compact('contact'));
    }
    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return view('admin.images.show', compact('contact'));
    }
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        // バリデーション
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'content' => 'required|string',
            'channels' => 'nullable|array',
            'channels.*' => 'string',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // チェックボックス（配列）をJSONで保存
        $contact->channels = $request->channels ? json_encode($request->channels) : null;

        // 画像がアップロードされた場合
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $contact->image = $path;
        }

        // その他の項目を更新
        $contact->last_name = $request->last_name;
        $contact->first_name = $request->first_name;
        $contact->content = $request->content;

        $contact->save();

        return redirect()->route('admin.images.show', $id)
            ->with('success', '更新が完了しました');
    }
}
