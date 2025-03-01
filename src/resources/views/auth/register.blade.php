@extends('layouts.app')

@section('title','登録ページ')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('page-title','Register')

@section('action','/login')
@section('method','get')
@section('button-name','login')

@section('content')
<div class="register-form">
    <form action="/register" method="post" class="form" novalidate>
        @csrf
        <div class="register-content">
            <div class="register-content__item">
                <div class="register-content__item-title">お名前</div>
                <div class="register-content__item-input">
                    <input type="text" name="name" placeholder="例: 山田　太郎" value="{{ old('name') }}">
                </div>
                @error('name')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="register-content__item">
                <div class="register-content__item-title">メールアドレス</div>
                <div class="register-content__item-input">
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                </div>
                @error('email')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="register-content__item">
                <div class="register-content__item-title">パスワード</div>
                <div class="register-content__item-input">
                    <input type="password" name="password" placeholder="例: coachtech1106">
                </div>
                @error('password')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="register-content__button">
            <button type="submit" class="register-content__button-submit">登録</button>
        </div>
    </form>
</div>
@endsection