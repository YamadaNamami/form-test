@extends('layouts.app')

@section('title','お問い合わせフォームの確認画面')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('page-title','Confirm')

@section('content')
<div class="confirm-form__content">
    <form action="/confirm" method="post" class="confirm-form">
        @csrf
        <table class="confirm-form__table">
            <tr class="confirm-form__table-row">
                <th class="confirm-form__table-header">お名前</th>
                <td class="confirm-form__table-detail">
                    <input type="text" value="{{ $contact['last_name'] }} {{ $contact['first_name'] }}" readonly>
                    <input type="hidden" name="last_name"
                    value="{{ $contact['last_name'] }} " >
                    <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" >
                </td>
            </tr>
            <tr class="confirm-form__table-row">
                <th class="confirm-form__table-header">性別</th>
                <td class="confirm-form__table-detail">
                    <input type="text" value="{{ $contact['gender'] == 1? '男性':($contact['gender'] == 2? '女性':'その他') }} " readonly>
                    <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                </td>
            </tr>
            <tr class="confirm-form__table-row">
                <th class="confirm-form__table-header">メールアドレス</th>
                <td class="confirm-form__table-detail">
                    <input type="text" name="email" value="{{ $contact['email'] }}" readonly>
                </td>
            </tr>
            <tr class="confirm-form__table-row">
                <th class="confirm-form__table-header">電話番号</th>
                <td class="confirm-form__table-detail">
                    <input type="text" name="tel" value="{{ $contact['tel1'].$contact['tel2'].$contact['tel3'] }}" readonly>
                    <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
                    <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
                    <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
                </td>
            </tr>
            <tr class="confirm-form__table-row">
                <th class="confirm-form__table-header">住所</th>
                <td class="confirm-form__table-detail">
                    <input type="text" name="address" value="{{ $contact['address'] }}" readonly>
                </td>
            </tr>
            <tr class="confirm-form__table-row">
                <th class="confirm-form__table-header">建物名</th>
                <td class="confirm-form__table-detail">
                    <input type="text" name="building" value="{{ $contact['building'] }}" readonly>
                </td>
            </tr>
            <tr class="confirm-form__table-row">
                <th class="confirm-form__table-header">お問い合わせの種類</th>
                <td class="confirm-form__table-detail">
                    <input type="text" value="{{ $category['content'] }}" readonly>
                    <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                </td>
            </tr>
            <tr class="confirm-form__table-row">
                <th class="confirm-form__table-header">お問い合わせ内容</th>
                <td class="confirm-form__table-detail">
                    <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly>
                </td>
            </tr>
        </table>
        <div class="confirm-form__button-group">
            <div class="confirm-form__button">
                <button type="submit" class="confirm-form__button-submit">送信</button>
            </div>
            <div class="revise-form__button">
                <button type="submit" class="revise-form__button-submit" name="back" value="back">修正</button>
            </div>
        </div>
    </form>
</div>
@endsection