@extends('layouts.app')

@section('content')
<div class="container">
    <h2>画像詳細</h2>

    <div class="mb-3">
        <strong>名前：</strong>
        {{ $contact->last_name }} {{ $contact->first_name }}
    </div>

    <div class="mb-3">
        <strong>お問い合わせ内容：</strong>
        <p>{{ $contact->content }}</p>
    </div>

    <div class="mb-3">
        <strong>どこで知りましたか：</strong>
        <ul>
            @foreach ($contact->channels as $channel)
            <li>{{ $channel->name }}</li>
            @endforeach
        </ul>
    </div>

    <div class="mb-3">
        <strong>画像：</strong><br>
        <img src="{{ asset('storage/' . $contact->image) }}" width="400">
    </div>

    <a href="{{ route('admin.images.index') }}">← 画像一覧に戻る</a>
</div>
@endsection