@extends('layouts.app')

@section('title','ログインページ')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('page-title','Login')

@section('action','/register')
@section('method','get')
@section('button-name','register')

@section('content')
<div class="login-form">
    <form action="/login" method="post" class="form" novalidate>
        @csrf
        <div class="login-content">
            <div class="login-content__item">
                <div class="login-content__item-title">メールアドレス</div>
                <div class="login-content__item-input">
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                </div>
                @error('email')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="login-content__item">
                <div class="login-content__item-title">パスワード</div>
                <div class="login-content__item-input">
                    <input type="password" name="password" placeholder="例: coachtech1106">
                </div>
                @error('password')
                <div class="error-message">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="login-content__button">
            <button type="submit" class="login-content__button-submit">ログイン</button>
        </div>
    </form>
</div>
@endsection