@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__content">
  <h2>お問い合わせありがとうございました</h2>
  <p>送信が完了しました。</p>

  <div class="thanks__button">
    <a href="{{ route('input') }}" class="btn btn-primary">トップへ戻る</a>
  </div>
</div>
@endsection