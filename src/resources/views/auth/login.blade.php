<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン - FashionablyLate</title>

    <link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <header class="auth-header">
        <div class="auth-header__inner">
            <h1>FashionablyLate</h1>
            <a href="{{ route('register') }}" class="auth-header__button">register</a>
        </div>
    </header>

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
</body>
</html>