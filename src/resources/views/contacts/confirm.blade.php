@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
  <div class="confirm__heading">
    <h2>お問い合わせ内容確認</h2>
  </div>

  <form class="form" action="{{ url('/contacts') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @php
    $genderLabel = [
    1 => '男性',
    2 => '女性',
    3 => 'その他'
    ][$inputs['gender']];

    $category = \App\Models\Category::find($inputs['category_id']);
    @endphp

    <table class="confirm-table__inner">

      <tr>
        <th>お名前</th>
        <td>
          {{ $inputs['last_name'] }} {{ $inputs['first_name'] }}
          <input type="hidden" name="last_name" value="{{ $inputs['last_name'] }}">
          <input type="hidden" name="first_name" value="{{ $inputs['first_name'] }}">
        </td>
      </tr>

      <tr>
        <th>性別</th>
        <td>
          {{ $genderLabel }}
          <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">
        </td>
      </tr>

      <tr>
        <th>メールアドレス</th>
        <td>
          {{ $inputs['email'] }}
          <input type="hidden" name="email" value="{{ $inputs['email'] }}">
        </td>
      </tr>

      <tr>
        <th>電話番号</th>
        <td>
          {{ $inputs['tel_1'] }}-{{ $inputs['tel_2'] }}-{{ $inputs['tel_3'] }}
          <input type="hidden" name="tel_1" value="{{ $inputs['tel_1'] }}">
          <input type="hidden" name="tel_2" value="{{ $inputs['tel_2'] }}">
          <input type="hidden" name="tel_3" value="{{ $inputs['tel_3'] }}">
        </td>
      </tr>

      <tr>
        <th>住所</th>
        <td>
          {{ $inputs['address'] }}
          <input type="hidden" name="address" value="{{ $inputs['address'] }}">
        </td>
      </tr>

      <tr>
        <th>建物</th>
        <td>
          {{ $inputs['building'] }}
          <input type="hidden" name="building" value="{{ $inputs['building'] }}">
        </td>
      </tr>

      <tr>
        <th>お問い合わせの種類</th>
        <td>
          {{ $category->name }}
          <input type="hidden" name="category_id" value="{{ $inputs['category_id'] }}">
        </td>
      </tr>

      <tr>
        <th>お問い合わせ内容</th>
        <td>
          {{ $inputs['content'] }}
          <input type="hidden" name="content" value="{{ $inputs['content'] }}">
        </td>
      </tr>

      <tr>
        <th>どこで知りましたか</th>
        <td>
          @foreach ($channels as $channel)
          <div>{{ $channel->name }}</div>
          <input type="hidden" name="channels[]" value="{{ $channel->id }}">
          @endforeach
        </td>
      </tr>

      <tr>
        <th>画像</th>
        <td>
          @if (!empty($inputs['image']))
          <img src="{{ asset('storage/' . $inputs['image']) }}" width="200">
          <input type="hidden" name="image" value="{{ $inputs['image'] }}">
          @else
          なし
          @endif
        </td>
      </tr>

    </table>

    <div class="form__button">
      <button class="form__button-submit" type="submit">送信</button>
    </div>

  </form>
</div>
@endsection