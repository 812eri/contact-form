@extends('layouts.app')

@section('title', '管理画面 - FashionablyLate')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header')
    <header class="header">
        <div class="header__inner">
            <h1>FashionablyLate</h1>
            <form method="post" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout__button">logout</button>
            </form>
        </div>
    </header>
@endsection

@section('content')
        <div class="admin-form__content">
            <div class="admin-form__heading">
                <h2>Admin</h2>
            </div>

            @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
            @endif

            <form class="search-form" action="/admin" method="get">
            <div class="search-form__row">
                <input type="text" name="keyword" class="search-input" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">

            <select name="gender" class="search-select">
                <option value="">性別</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>

            <select name="category_id" class="search-select">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
                @endforeach
            </select>

            <input type="date" name="date" class="search-select" value="{{ request('date') }}">

            <button type="submit" class="search-button">検索</button>
            <a href="/admin" class="reset-button">リセット</a>
            </div>
        </form>

        <div class="table-controls">
            <form action="{{ route('admin.export') }}" method="get" style="display: inline;">
                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                <input type="hidden" name="gender" value="{{ request('gender') }}">
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                <input type="hidden" name="date" value="{{ request('date') }}">
                <button type="submit" class="export-button">エクスポート</button>
            </form>
            {{ $contacts->appends(request()->query())->links() }}
        </div>

        <div class="admin-table">
            <table class="admin-table__inner">
                <thead>
                    <tr>
                        <th>お名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>お問い合わせの種類</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                    <tr>
                        <td>{{ $contact->last_name }} {{$contact->first_name }}</td>
                        <td>
                            @php
                                $genders = [1 => '男性', 2 => '女性', 3 => 'その他'];
                            @endphp
                            {{ $genders[$contact->gender] ?? '' }}
                        </td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->category->content ?? '' }}</td>
                        <td><button type="button" class="detail-button" onclick='showDetail(@json($contact->load("category")))'>詳細</button></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="no-data">
                            お問い合わせデータがありません
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </div>
@endsection

    <div id="detailModal" class="modal">
        <div class="modal-content">
            <span class="modal-close">&times;</span>

            <table class="modal-table">
                <tr>
                    <th>お名前</th>
                    <td id="modal-name"></td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td id="modal-gender"></td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td id="modal-email"></td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td id="modal-tel"></td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td id="modal-address"></td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td id="modal-building"></td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td id="modal-category"></td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td id="modal-detail"></td>
                </tr>
            </table>

            <form id="deleteForm" method="post" style="margin-top: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button">削除</button>
            </form>
        </div>
    </div>

    @section('scripts')
    <script>
        const modal = document.getElementById('detailModal');
        const closeBtn = document.querySelector('.modal-close');

        function showDetail(contact) {
            document.getElementById('modal-name').textContent = contact.last_name + ' ' + contact.first_name;

            const genders = {'1': '男性', '2': '女性', '3': 'その他'};
            document.getElementById('modal-gender').textContent = genders[contact.gender] || '';

            document.getElementById('modal-email').textContent = contact.email;
            document.getElementById('modal-tel').textContent = contact.tel;
            document.getElementById('modal-address').textContent = contact.address;
            document.getElementById('modal-building').textContent = contact.building || '';
            document.getElementById('modal-category').textContent = contact.category ? contact.category.content : '';
            document.getElementById('modal-detail').textContent = contact.detail;

            document.getElementById('deleteForm').action = '/admin/delete/' + contact.id;

            modal.style.display = 'block';
        }

        closeBtn.onclick = function() {
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
@endsection