@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
  <div class="contact-form__heading">
    <h2>お問い合わせ</h2>
  </div>
  <form class="form" action="contacts/confirm" method="post" novalidate>
    @csrf
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お名前</span>
        <span class="form__label--required">必須</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <div class="name">
            <ul>
              <li><input type="text" name="last_name" placeholder="山田" value="{{ old('last_name') }}" /></li>
              <li><input type="text" name="first_name" placeholder="太郎" value="{{ old('first_name') }}" /></li>
            </ul>
          </div>
        </div>
        <div class="form__error">
          @error('last_name')
          {{ $message }}
          @enderror
           @error('first_name')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">性別</span>
        <span class="form__label--required">※</span>
      </div> 
          <input type="radio" name="gender" value="1" checked/>男性
          <input type="radio" name="gender" value="2" />女性
          <input type="radio" name="gender" value="3" />その他
     </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">メールアドレス</span>
        <span class="form__label--required">必須</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}" />
        </div>
        <div class="form__error">
          @error('email')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">電話番号</span>
        <span class="form__label--required">必須</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <div class="tel">
            <ul>
              <li><input type="tel" name="tel_1" placeholder="090" value="{{ old('tel_1') }}" /></li>
              <li><input type="tel" name="tel_2" placeholder="1234" value="{{ old('tel_2') }}" /></li>
              <li><input type="tel" name="tel_3" placeholder="5678" value="{{ old('tel_3') }}" /></li>
            </ul>
          </div>
        </div>
        <div class="form__error">
          @error('tel_1')
          {{ $message }}
          @enderror
          @error('tel_2')
          {{ $message }}
          @enderror 
          @error('tel_3')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">住所</span>
        <span class="form__label--required">必須</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="text" name="address" placeholder="東京都葛飾区" value="{{ old('address') }}" />
        </div>
        <div class="form__error">
          @error('address')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">建物</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="text" name="building" placeholder="辻森コーポ" value="{{ old('building') }}" />
        </div>
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お問い合わせの種類</span>
        <span class="form__label--required">必須</span>
      </div>
      
      <select name="kind">
        <option value="" disabled selected>選択してください</option>
        <option value="1.商品のお届けについて">商品のお届けについて </option>
        <option value="2.商品の交換について">商品の交換について</option>
        <option value="3.商品トラブル">商品トラブル</option>
        <option value="4.ショップへのお問い合わせ">ショップへのお問い合わせ</option>
        <option value="5.その他">その他</option>
      </select>
      <div class="form__error">
          @error('kind')
          {{ $message }}
          @enderror
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お問い合わせ内容</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--textarea">
          <textarea name="content" placeholder="資料をいただきたいです">{{ old('content') }}</textarea>
        </div>
        <div class="form__error">
          @error('content')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    <div class="form__button">
      <button class="form__button-submit" type="submit">送信</button>
    </div>
  </form>
</div>
@endsection
