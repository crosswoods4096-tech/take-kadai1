@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4">問い合わせ管理</h2>

    {{-- 検索フォーム --}}
    <form action="{{ route('admin.contacts.index') }}" method="GET" class="mb-4">
        <div class="row g-3">

            {{-- 名前 --}}
            <div class="col-auto">
                <label class="form-label">名前</label>
                <input type="text" name="name" value="{{ request('name') }}" class="form-control">
            </div>

            {{-- 性別 --}}
            <div class="col-auto">
                <label class="form-label">性別</label>
                <select name="gender" class="form-select">
                    <option value="">指定なし</option>
                    <option value="1" @selected(request('gender')=='1' )>男性</option>
                    <option value="2" @selected(request('gender')=='2' )>女性</option>
                    <option value="3" @selected(request('gender')=='3' )>その他</option>
                </select>
            </div>

            {{-- メールアドレス --}}
            <div class="col-auto">
                <label class="form-label">メールアドレス</label>
                <input type="text" name="email" value="{{ request('email') }}" class="form-control">
            </div>

            {{-- お問い合わせ種類 --}}
            <div class="col-auto">
                <label class="form-label">お問い合わせ種類</label>
                <select name="type" class="form-select">
                    <option value="">指定なし</option>
                    <option value="1" @selected(request('type')=='1' )>商品のお届けについて</option>
                    <option value="2" @selected(request('type')=='2' )>商品の交換について</option>
                    <option value="3" @selected(request('type')=='3' )>商品トラブル</option>
                    <option value="4" @selected(request('type')=='4' )>ショップへのお問い合わせ</option>
                    <option value="5" @selected(request('type')=='5' )>その他</option>
                </select>
            </div>

            {{-- お問い合わせ内容 --}}
            <div class="col-auto">
                <label class="form-label">内容</label>
                <input type="text" name="content" value="{{ request('content') }}" class="form-control">
            </div>

            {{-- 日付 --}}
            <div class="col-auto">
                <label class="form-label">日付</label>
                <input type="date" name="date" value="{{ request('date') }}" class="form-control">
            </div>

            {{-- 検索ボタン --}}
            <div class="col-auto d-flex align-items-end">
                <button type="submit" class="btn btn-primary">検索</button>
            </div>

        </div>
    </form>

    {{-- 問い合わせ一覧 --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>名字</th>
                <th>名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>内容</th>
                <th>登録日</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($contacts as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->last_name }}</td>
                <td>{{ $contact->first_name }}</td>
                <td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ Str::limit($contact->content, 30) }}</td>
                <td>{{ $contact->created_at->format('Y-m-d') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">データがありません</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- ページネーション --}}
    <div class="mt-3">
        {{ $contacts->links() }}
    </div>

</div>
@endsection