@extends('layouts.app')

@section('title','サンクスページ')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-content">
    <div class="thanks-content__message">
        <p class="tanks-content__message-text">お問い合わせありがとうございました</p>
    </div>
    <button class="thanks-content__button">
        <a href="/" class="thanks-content__link">HOME</a>
    </button>
</div>
@endsection
