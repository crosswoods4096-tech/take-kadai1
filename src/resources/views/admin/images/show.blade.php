@extends('layouts.app')

@section('content')
<h2>画像詳細（編集）</h2>

@if(session('success'))
<p style="color: green;">{{ session('success') }}</p>
@endif

{{-- バリデーションエラー --}}
@if ($errors->any())
<div style="color:red;">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.images.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- 名前 --}}
    <div>
        <label>姓：</label>
        <input type="text" name="last_name" value="{{ old('last_name', $contact->last_name) }}">
    </div>

    <div>
        <label>名：</label>
        <input type="text" name="first_name" value="{{ old('first_name', $contact->first_name) }}">
    </div>

    {{-- 問い合わせ内容 --}}
    <div>
        <label>問い合わせ内容：</label>
        <textarea name="content">{{ old('content', $contact->content) }}</textarea>
    </div>

    {{-- どこで知りましたか --}}
    <div>
        <label>どこで知りましたか：</label><br>

        @php
        $selected = $contact->channels ?? [];
        @endphp

        <label>
            <input type="checkbox" name="channels[]" value="site"
                {{ in_array('site', $selected) ? 'checked' : '' }}>
            自社サイト
        </label><br>

        <label>
            <input type="checkbox" name="channels[]" value="search"
                {{ in_array('search', $selected) ? 'checked' : '' }}>
            検索エンジン
        </label><br>

        <label>
            <input type="checkbox" name="channels[]" value="sns"
                {{ in_array('sns', $selected) ? 'checked' : '' }}>
            SNS
        </label><br>

        <label>
            <input type="checkbox" name="channels[]" value="media"
                {{ in_array('media', $selected) ? 'checked' : '' }}>
            テレビ・新聞
        </label><br>

        <label>
            <input type="checkbox" name="channels[]" value="friend"
                {{ in_array('friend', $selected) ? 'checked' : '' }}>
            友人・知人
        </label>
    </div>

    {{-- 画像 --}}
    <div>
        <label>現在の画像：</label><br>

        @if ($contact->image)
        <img src="{{ asset('storage/' . $contact->image) }}" width="200"><br>
        @else
        <p>画像なし</p>
        @endif

        <label>画像を変更：</label>
        <input type="file" name="image">
    </div>

    <button type="submit">修正する</button>
</form>
{{-- ▼▼ 削除ボタンフォームを追加 ▼▼ --}}
<form action="{{ route('admin.images.delete', $contact->id) }}" method="POST" style="margin-top: 20px;">
    @csrf
    @method('DELETE')

    <button type="submit"
        onclick="return confirm('本当に削除しますか？');"
        style="background-color: red; color: white; padding: 8px 16px; border: none; cursor: pointer;">
        削除する
    </button>
</form>
{{-- ▲▲ 削除ボタンフォームを追加 ▲▲ --}}
@endsection