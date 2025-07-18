@extends('layouts.app')

@section('title','お問い合わせフォームの入力画面')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('page-title','Contact')

@section('content')
<div class="contact-form__content">
    <form action="/" method="post" class="contact-form" novalidate>
        @csrf
        <div class="contact-form__group">
            <div class="contact-form__group-title">
                <label for="name">
                    <span class="contact-form__item-title">お名前</span>
                    <span class="contact-form__item-title--required">※</span>
                </label>
            </div>
            <div class="contact-form__group-content contact-form__input-name">
                <div class="contact-form__input-content--column">
                    <input type="text" name="last_name" id="name" class="contact-form__item-input" placeholder="例: 山田" value="{{ old('last_name') }}">
                </div>
                <div class="contact-form__input-content--column">
                    <input type="text" name="first_name" class="contact-form__item-input" placeholder="例: 太郎" value="{{ old('first_name') }}">
                </div>
            </div>
        </div>
        @if($errors->has('last_name')||$errors->has('first_name'))
        <div class="error-message__content">
            <div class="error-message__content--name">
                @if($errors->has('last_name'))
                {{ $errors->first('last_name') }}
                @endif
            </div>
            <div class="error-message__content--name">
                @if($errors->has('first_name'))
                {{  $errors->first('first_name') }}
                @endif
            </div>
        </div>
        @endif
        <div class="contact-form__group">
            <div class="contact-form__group-title">
                <span class="contact-form__item-title">性別</span>
                <span class="contact-form__item-title--required">※</span>
            </div>
            <div class="contact-form__group-content contact-form__input-gender">
                <div class="contact-form__input-content--row">
                    <div class="input-gender__radio">
                        <input type="radio" name="gender" value="1" {{ old('gender')==1?"checked":"" }} id="man" checked>
                        <label for="man">男性</label>
                    </div>
                    <div class="input-gender__radio">
                        <input type="radio" name="gender" value="2" {{ old('gender')==2?"checked":"" }} id="woman">
                        <label for="woman">女性</label>
                    </div>
                    <div class="input-gender__radio">
                        <input type="radio" name="gender" value="3" {{ old('gender')==3?"checked":"" }} id="other">
                        <label for="other">その他</label>
                    </div>
                </div>
            </div>
        </div>
        @error('gender')
        <div class="error-message__content">
            <div class="error-message__content--gender">
                {{ $message }}
            </div>
        </div>
        @enderror
        <div class="contact-form__group">
            <div class="contact-form__group-title">
                <label for="email">
                    <span class="contact-form__item-title">メールアドレス</span>
                    <span class="contact-form__item-title--required">※</span>
                </label>
            </div>
            <div class="contact-form__group-content">
                <div class="contact-form__input-content--column">
                    <input type="email" name="email" id="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                </div>
            </div>
        </div>
        @error('email')
        <div class="error-message__content">
            <div class="error-message__content--email">
                {{ $message }}
            </div>
        </div>
        @enderror
        <div class="contact-form__group">
            <div class="contact-form__group-title">
                <label for="tel">
                    <span class="contact-form__item-title">電話番号</span>
                    <span class="contact-form__item-title--required">※</span>
                </label>
            </div>
            <div class="contact-form__group-content contact-form__input-tel">
                <div class="contact-form__input-content--column">
                    <input type="tel" name="tel1" id="tel" placeholder="080" value="{{ old('tel1') }}">
                </div>
                <span class="contact-form__item-input--hyphen">-</span>
                <div class="contact-form__input-content--column">
                    <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
                </div>
                <span class="contact-form__item-input--hyphen">-</span>
                <div class="contact-form__input-content--column">
                    <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
                </div>
            </div>
        </div>
        @if($errors->has('tel1'))
        <div class="error-message__content">
            <div class="error-message__content--tel">
                {{ $errors->first('tel1') }}
            </div>
        </div>
        @elseif($errors->has('tel2'))
        <div class="error-message__content">
            <div class="error-message__content--tel">
                {{ $errors->first('tel2') }}
            </div>
        </div>
        @else
        <div class="error-message__content">
            <div class="error-message__content--tel">
                {{ $errors->first('tel3') }}
            </div>
        </div>
        @endif
        <div class="contact-form__group">
            <div class="contact-form__group-title">
                <label for="address">
                    <span class="contact-form__item-title">住所</span>
                    <span class="contact-form__item-title--required">※</span>
                </label>
            </div>
            <div class="contact-form__group-content">
                <div class="contact-form__input-content--column">
                    <input type="text" name="address" id="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                </div>
            </div>
        </div>
        @error('address')
        <div class="error-message__content">
            <div class="error-message__content--address">
                {{ $message }}
            </div>
        </div>
        @enderror
        <div class="contact-form__group">
            <div class="contact-form__group-title">
                <label for="building">
                    <span class="contact-form__item-title">建物名</span>
                </label>
            </div>
            <div class="contact-form__group-content">
                <input type="text" name="building" id="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
            </div>
        </div>
        <div class="contact-form__group">
            <div class="contact-form__group-title">
                <label for="category">
                    <span class="contact-form__item-title">お問い合わせの種類</span>
                    <span class="contact-form__item-title--required">※</span>
                </label>
            </div>
            <div class="contact-form__group-content contact-form__select-category">
                <div class="contact-form__input-content--column">
                    <select name="category_id" id="category" required>
                        <option value="">選択してください</option>
                        @foreach($categories as $category)
                        <option value="{{ $category['id'] }}" {{old('category_id', ('category_id')) == $category['id'] ? 'selected' : '' }}>{{ $category['content'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @error('category_id')
        <div class="error-message__content">
            <div class="error-message__content--category">
                {{ $message }}
            </div>
        </div>
        @enderror
        <div class="contact-form__group">
            <div class="contact-form__group-title">
                <label for="detail">
                    <span class="contact-form__item-title">お問い合わせ内容</span>
                    <span class="contact-form__item-title--required">※</span>
                </label>
            </div>
            <div class="contact-form__group-content">
                <div class="contact-form__input-content--column">
                    <textarea name="detail" id="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                </div>
            </div>
        </div>
        @error('detail')
        <div class="error-message__content">
            <div class="error-message__content--category">
                {{ $message }}
            </div>
        </div>
        @enderror
        <div class="contact-form__button">
            <button type="submit" class="contact-form__button-submit">確認画面</button>
        </div>
    </form>
</div>
@endsection