@extends('layouts.app')

@section('title', 'お問い合わせ - FashionablyLate')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
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
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2>Contact</h2>
            </div>
            <form class="form" action="/confirm" method="post">
                @csrf
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お名前</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="last_name" placeholder="例:山田" value="{{ old('last_name', $contact['last_name'] ?? '') }}" />
                            <input type="text" name="first_name" placeholder="例:太郎" value="{{ old('first_name', $contact['first_name'] ?? '') }}" />
                        </div>
                        <div class="form__error">
                            @error('last_name')
                            <p>{{ $message }}</p>
                            @enderror
                            @error('first_name')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">性別</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--radio">
                            <label><input type="radio" name="gender" value="1" {{ (old('gender', $contact['gender'] ?? '') == '1') ? 'checked' : '' }}>
                                男性
                            </label>
                            <label><input type="radio" name="gender" value="2" {{ (old('gender', $contact['gender'] ?? '') == '2') ? 'checked' : '' }}>
                                女性
                            </label>
                            <label><input type="radio" name="gender" value="3" {{ (old('gender', $contact['gender'] ?? '') == '3') ? 'checked' : '' }}>
                                その他
                            </label>
                        </div>
                        <div class="form__error">
                            @error('gender')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">メールアドレス</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="email" name="email" placeholder="例:test@example.com" value="{{ old('email', $contact['email'] ?? '') }}" />
                        </div>
                        <div class="form__error">
                            @error('email')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">電話番号</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--tel">
                            <input type="text" name="tel1" placeholder="080" value="{{ old('tel1', $contact['tel1'] ?? '') }}" />
                            <span>-</span>
                            <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2', $contact['tel2'] ?? '') }}" />
                            <span>-</span>
                            <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3', $contact['tel3'] ?? '') }}" />
                        </div>
                        <div class="form__error">
                            @error('tel1')
                            <p>{{ $message }}</p>
                            @enderror
                            @error('tel2')
                            <p>{{ $message }}</p>
                            @enderror
                            @error('tel3')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">住所</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', $contact['address'] ?? '') }}" />
                        </div>
                        <div class="form__error">
                            @error('address')
                            <p>{{ $message }}</p>
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
                            <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101" value="{{ old('building', $contact['building'] ?? '') }}" />
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせの種類</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--select">
                            <select name="category_id" required {{ old('category_id', $contact['category_id'] ?? '') ? 'data-selected="true"' : '' }}>
                                <option value="">選択してください</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ (old('category_id', $contact['category_id'] ?? '') == $category->id) ? 'selected' : '' }}>
                                    {{ $category->content }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form__error">
                            @error('category_id')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせ内容</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--textarea">
                            <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', $contact['detail'] ?? '') }}</textarea>
                        </div>
                        <div class="form__error">
                            @error('detail')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form__button">
                    <button class="form__button-submit" type="submit">確認画面</button>
                </div>
            </form>
        </div>
@endsection

@section('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.querySelector('select[name="category_id"]');
        if (select) {
            select.addEventListener('change', function() {
                if (this.value !== '') {
                    this.style.color = '#000';
                } else {
                    this.style.color = '#beb1a6';
                }
            });

            // ページ読み込み時にも適用
            if (select.value !== '') {
                select.style.color = '#000';
            }
        }
    });
    </script>
@endsection