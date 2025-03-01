@extends('layouts.app')

@section('title','管理画面')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('page-title','Admin')

@section('action','/logout')
@section('method','post')
@section('button-name','logout')

@section('content')
<div class="admin-content">
    <div class="search-form__content">
        <form action="/admin/search" method="get" class="search-form">
            @csrf
            <div class="search-form__item">
                <input type="text" name="keyword" class="search-form__item-input search-form__item-input--name" placeholder="名前やメールアドレスを入力してください">
            </div>
            <div class="search-form__item search-form__item--select">
                <select name="gender" class="search-form__item-select search-form__item-select--gender">
                    <option value="">性別</option>
                    <option value="0">全て</option>
                    <option value="1">男性</option>
                    <option value="2">女性</option>
                    <option value="3">その他</option>
                </select>
            </div>
            <div class="search-form__item search-form__item--select">
                <select name="category_id" class="search-form__item-select search-form__item-select--category">
                    <option value="">お問い合わせの種類</option>
                    @foreach($categories as $category)
                    <option value="{{ old($category['id']) }}">{{ $category['content'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search-form__item">
                <input type="date" name="created_at" class="search-form__item-input search-form__item-input--date">
            </div>
            <div class="search-form__button">
                <button type="submit" class="search-form__button-submit">検索</button>
            </div>
        </form>
        <form action="" class="reset-form">
            <div class="reset-form__button">
                <button type="submit" class="reset-form__button-submit">リセット</button>
            </div>
        </form>
    </div>
    <div class="admin-content__sub-header">
        <form action="" class="export-form">
            <div class="export-form__button">
                <button type="submit" class="export-form__button-submit">エクスポート</button>
            </div>
        </form>
        {{ $contacts->links() }}
    </div>
    <div class="contact-list">
        <form action="" method="" class="contact-form">
            <table class="contact-form__table">
                <tr class="contact-form__table-row">
                    <th class="contact-form__table-header contact-form__table-header--name">お名前 </th>
                    <th class="contact-form__table-header contact-form__table-header--gender">性別 </th>
                    <th class="contact-form__table-header contact-form__table-header--email">メールアドレス</th>
                    <th class="contact-form__table-header contact-form__table-header--category" colspan="2">お問い合わせの種類</th>
                </tr>
                @foreach($contacts as $contact)
                <tr class="contact-form__table-row">
                    <td class="contact-form__table-detail contact-form__table-detail--name">
                        <input type="text" name="name" class="contact-form__table-input" value="{{ $contact['last_name'] .'　'.$contact['first_name'] }}">
                    </td>
                    <td class="contact-form__table-detail contact-form__table-detail--gender">
                        <input type="text" name="gender" class="contact-form__table-input" value="{{ $contact['gender'] == 1? '男性':($contact['gender'] == 2? '女性':'その他') }}">
                    </td>
                    <td class="contact-form__table-detail contact-form__table-detail--email">
                        <input type="text" name="email" class="contact-form__table-input" value="{{ $contact['email'] }}">
                    </td>
                    <td class="contact-form__table-detail contact-form__table-detail--category">
                        <input type="text" name="content" class="contact-form__table-input" value="{{ $contact['category']['content'] }}">
                    </td>
                    <td class="contact-form__table-detail">
                        <button type="submit" class="contact-form__button-submit">詳細</button>
                    </td>
                </tr>
                @endforeach
            </table>
        </form>
    </div>
</div>
@endsection