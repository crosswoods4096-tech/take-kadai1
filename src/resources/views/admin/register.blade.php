@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 480px;">
    <h2 class="text-center mb-4">Register</h2>

    <form method="POST" action="{{ route('admin.register') }}">
        @csrf

        {{-- お名前 --}}
        <div class="mb-3">
            <label for="name" class="form-label">お名前</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        {{-- メールアドレス --}}
        <div class="mb-3">
            <label for="email" class="form-label">メールアドレス</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        {{-- パスワード --}}
        <div class="mb-4">
            <label for="password" class="form-label">パスワード</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        {{-- 送信ボタン --}}
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">登録する</button>
        </div>
    </form>
</div>
@endsection