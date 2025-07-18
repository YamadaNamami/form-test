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
                <input type="text" name="keyword" value="{{ request('keyword') }}" class="search-form__item-input search-form__item-input--name" placeholder="名前やメールアドレスを入力してください">
            </div>
            <div class="search-form__item search-form__item--select">
                <select name="gender" class="search-form__item-select search-form__item-select--gender">
                    <option disabled selected>性別</option>
                    <option value="0" {{ request('gender')==0?'selected':'' }}>全て</option>
                    <option value="1" {{ request('gender')==1?'selected':'' }}>男性</option>
                    <option value="2" {{ request('gender')==2?'selected':'' }}>女性</option>
                    <option value="3" {{ request('gender')==3?'selected':'' }}>その他</option>
                </select>
            </div>
            <div class="search-form__item search-form__item--select">
                <select name="category_id" class="search-form__item-select search-form__item-select--category">
                    <option value="">お問い合わせの種類</option>
                    @foreach($categories as $category)
                    <option value="{{ $category['id'] }}" @if(request('category_id')==$category['id']) selected @endif>{{ $category['content'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search-form__item">
                <input type="date" name="created_at" value="{{ request('created_at') }}" class="search-form__item-input search-form__item-input--date">
            </div>
            <div class="search-form__button">
                <button type="submit" class="search-form__button-submit">検索</button>
            </div>
            <div class="reset-form__button">
                <button type="submit" class="reset-form__button-submit" name="reset">リセット</button>
            </div>
        </form>
    </div>
    <div class="admin-content__sub-header">
        <form action="{{ url('/admin/export').'?'.http_build_query(request()->query()) }}" method="post" class="export-form">
            @csrf
            <div class="export-form__button">
                <button type="submit" class="export-form__button-submit">エクスポート</button>
            </div>
        </form>
        {{ $contacts->appends(request()->query())->links('vendor/pagination/default') }}
    </div>
    <div class="contact-list">
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
                        <a class="contact-form__button-submit" href="#{{ $contact['id'] }}">詳細</a>
                    </td>
                </tr>

                <!-- モーダル -->
                <div class="modal" id="{{ $contact['id'] }}">
                    <a href="#" class="modal-overlay"></a>
                        <div class="modal__inner">
                            <div class="modal__content">
                                <form action="/admin/delete"  method="post" class="modal__delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-form__group">
                                        <label for="" class="modal-form__label">お名前</label>
                                        <p>{{ $contact['last_name'] }}{{ $contact['first_name'] }}</p>
                                    </div>
                                    <div class="modal-form__group">
                                        <label for="" class="modal-form__label">性別</label>
                                        <p>
                                            @if($contact['gender'] == 1)
                                            男性
                                            @elseif($contact['gender'] == 2)
                                            女性
                                            @else
                                            その他
                                            @endif
                                        </p>
                                    </div>
                                    <div class="modal-form__group">
                                        <label for="" class="modal-form__label">メールアドレス</label>
                                        <p>{{ $contact['email'] }}</p>
                                    </div>
                                    <div class="modal-form__group">
                                        <label for="" class="modal-form__label">電話番号</label>
                                        <p>{{ $contact['tel'] }}</p>
                                    </div>
                                    <div class="modal-form__group">
                                        <label for="" class="modal-form__label">住所</label>
                                        <p>{{ $contact['address'] }}</p>
                                    </div>
                                    <div class="modal-form__group">
                                        <label for="" class="modal-form__label">建物名</label>
                                        <p>{{ $contact['building'] }}</p>
                                    </div>
                                    <div class="modal-form__group">
                                        <label for="" class="modal-form__label">お問い合わせの種類</label>
                                        <p>{{ $contact['category']['content'] }}</p>
                                    </div>
                                    <div class="modal-form__group">
                                        <label for="" class="modal-form__label">お問い合わせ内容</label>
                                        <p>{{ $contact['detail'] }}</p>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $contact['id'] }}">
                                    <input type="submit" class="modal-form__delete-btn btn" value="削除">
                                </form>
                            </div>
                            <a href="#" class="modal__close-btn">×</a>
                        </div>
                </div>
                @endforeach
            </table>
    </div>
</div>
@endsection