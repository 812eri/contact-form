@extends('layouts.app')

@section('title', 'ログイン - FashionablyLate')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('header')
    <header class="auth-header">
        <div class="auth-header__inner">
            <h1>FashionablyLate</h1>
            <a href="{{ route('register') }}" class="auth-header__button">register</a>
        </div>
    </header>
@endsection

@section('content')
    <main class="auth-main">
        <h2 class="auth-title">Login</h2>

        <div class="auth-container">
            <form class="auth-form" method="post"  action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">メールアドレス</label>
                    <input type="email" name="email" class="form-input" placeholder="例:test@example.com" value="{{ old('email') }}">
                    @error('email')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">パスワード</label>
                    <input type="password" name="password" class="form-input" placeholder="例:coachtech1106">
                    @error('password')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="auth-submit-button">ログイン</button>
            </form>
        </div>
    </main>
@endsection