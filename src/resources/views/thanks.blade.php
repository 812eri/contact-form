@extends('layouts.app')

@section('title', '送信完了- FashionablyLate')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
    <div class="thanks__wrap">
        <div class="thanks-bg" aria-hidden="true">Thank you</div>
        <div class="thanks__content">
            <div class="thanks__heading">
                <p>お問い合わせありがとうございました</p>
            </div>
            <a href="/" class="home__button">HOME</a>
        </div>
    </div>
@endsection
