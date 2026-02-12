@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
  <div class="confirm__heading">
    <h2>お問い合わせ内容確認</h2>
  </div>

  <form class="form" action="{{ url('/contacts') }}" method="post" novalidate>
    @csrf

    @php
    $genderLabel = [
    1 => '男性',
    2 => '女性',
    3 => 'その他'
    ][$inputs['gender']];

    $category = \App\Models\Category::find($inputs['category_id']);
    @endphp

    <div class="confirm-table">
      <table class="confirm-table__inner">

        <tr class="confirm-table__row">
          <th class="confirm-table__header">お名前</th>
          <td class="confirm-table__text">
            <div class="name">
              <ul>
                <li><input type="text" name="last_name" value="{{ $inputs['last_name'] }}" readonly /></li>
                <li><input type="text" name="first_name" value="{{ $inputs['first_name'] }}" readonly /></li>
              </ul>
            </div>
          </td>
        </tr>

        <tr class="confirm-table__row">
          <th class="confirm-table__header">性別</th>
          <td class="confirm-table__text">
            <input type="text" name="gender_label" value="{{ $genderLabel }}" readonly />
            <input type="hidden" name="gender" value="{{ $inputs['gender'] }}" />
          </td>
        </tr>

        <tr class="confirm-table__row">
          <th class="confirm-table__header">メールアドレス</th>
          <td class="confirm-table__text">
            <input type="email" name="email" value="{{ $inputs['email'] }}" readonly />
          </td>
        </tr>

        <tr class="confirm-table__row">
          <th class="confirm-table__header">電話番号</th>
          <td class="confirm-table__text">
            <div class="tel">
              <ul>
                <li><input type="text" name="tel_1" value="{{ $inputs['tel_1'] }}" readonly /></li>
                <li><input type="text" name="tel_2" value="{{ $inputs['tel_2'] }}" readonly /></li>
                <li><input type="text" name="tel_3" value="{{ $inputs['tel_3'] }}" readonly /></li>
              </ul>
            </div>
          </td>
        </tr>

        <tr class="confirm-table__row">
          <th class="confirm-table__header">住所</th>
          <td class="confirm-table__text">
            <input type="text" name="address" value="{{ $inputs['address'] }}" readonly />
          </td>
        </tr>

        <tr class="confirm-table__row">
          <th class="confirm-table__header">建物</th>
          <td class="confirm-table__text">
            <input type="text" name="building" value="{{ $inputs['building'] }}" readonly />
          </td>
        </tr>

        <tr class="confirm-table__row">
          <th class="confirm-table__header">お問い合わせの種類</th>
          <td class="confirm-table__text">
            <input type="text" value="{{ $category->name }}" readonly />
            <input type="hidden" name="category_id" value="{{ $inputs['category_id'] }}">
          </td>
        </tr>

        <div class="confirm-table">
          <table class="confirm-table__inner">

            {{-- ここまでが既存の行 --}}
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせ内容</th>
              <td class="confirm-table__text">
                <input type="text" name="content" value="{{ $inputs['content'] }}" readonly />
              </td>
            </tr>

            {{-- ★ ここに移動させる！ --}}
            <tr class="confirm-table__row">
              <th class="confirm-table__header">どこで知りましたか</th>
              <td class="confirm-table__text">
                @if (!empty($channels))
                <div class="channels-wrapper" style="display: flex; flex-wrap: wrap; gap: 10px;">
                  @foreach ($channels as $channel)
                  <div class="channel-item" style="padding: 6px 12px; background: #f0f0f0; border-radius: 4px;">
                    {{ $channel->name }}
                  </div>
                  <input type="hidden" name="channels[]" value="{{ $channel->id }}">
                  @endforeach
                </div>
                @else
                <p>未選択</p>
                @endif
              </td>
            </tr>

          </table>
        </div>

        <div class="form__button">
          <button class="form__button-submit" type="submit">送信</button>
        </div>

  </form>
</div>
@endsection