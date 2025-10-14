@extends('layouts.app')

@section('title', '確認画面 - FashionablyLate')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('header')
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>
        </div>
    </header>
@endsection

@section('content')
        <div class="confirm__content">
            <div class="confirm__heading">
                <h2>Confirm</h2>
            </div>
                <div class="confirm-table">
                    <table class="confirm-table__inner">
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お名前</th>
                            <td class="confirm-table__text">
                                {{ $contact['last_name'] }} {{ $contact['first_name'] }}
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">性別</th>
                            <td class="confirm-table__text">
                                @php
                                    $genders = [1 => '男性', 2 => '女性', 3 => 'その他'];
                                @endphp
                                {{ $genders[$contact['gender']] ?? '' }}
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">メールアドレス</th>
                            <td class="confirm-table__text">
                                {{ $contact['email'] }}
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">電話番号</th>
                            <td class="confirm-table__text">
                                {{ $contact['tel'] }}
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">住所</th>
                            <td class="confirm-table__text">
                                {{ $contact['address'] }}
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">建物名</th>
                            <td class="confirm-table__text">
                                {{ $contact['building'] ?? '' }}
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせの種類</th>
                            <td class="confirm-table__text">
                                {{ $contact['category_name'] }}
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせ内容</th>
                            <td class="confirm-table__text">
                                {{ $contact['detail'] ?? '' }}
                            </td>
                        </tr>
                    </table>
                </div>

                <form class="form" action="/thanks" method="post">
                    @csrf
                    <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}"/>
                    <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}"/>
                    <input type="hidden" name="gender" value="{{ $contact['gender'] }}"/>
                    <input type="hidden" name="email" value="{{ $contact['email'] }}"/>
                    <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}"/>
                    <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}"/>
                    <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}"/>
                    <input type="hidden" name="address" value="{{ $contact['address'] }}"/>
                    <input type="hidden" name="building" value="{{ $contact['building'] ?? ''}}"/>
                    <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}"/>
                    <input type="hidden" name="detail" value="{{ $contact['detail'] }}"/>

                    <div class="form__button">
                        <button class="form__button-submit" type="submit">送信</button>
                        <button class="form__button-edit" type="submit" formaction="/" formmethod="post">修正</button>
                    </div>
                </form>
        </div>
@endsection
