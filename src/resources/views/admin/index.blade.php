@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header_button')
<form action="/logout" method="POST">
    @csrf
    <button type="submit" class="header-btn">logout</button>
</form>
@endsection

@section('content')
<div class="Admin-container">
    <h1 class="Admin-title">Admin</h1>
    <div class="Admin-container-search">
        <form action="{{ route('admin.index') }}" method="GET" class="Admin-search-form">
            <input type="text" name="keyword" class="Admin-search-input" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">
            <select name="gender" class="Admin-search-select">
                <option value="" {{ request('gender') === '' ? 'selected' : '' }}>性別</option>
                <option value="" {{ request('gender') == '' ? 'selected' : '' }}>全て</option>
                <option value="0" {{ request('gender') == '0' ? 'selected' : '' }}>男性</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>女性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>その他</option>
            </select>
            <select name="category_id" class="Admin-search-select">
                <option value="">お問い合わせの種類を選択してください</option>
                <option value="1" {{ request('category_id') == '1' ? 'selected' : '' }}>商品のお届けについて</option>
                <option value="2" {{ request('category_id') == '2' ? 'selected' : '' }}>商品の交換について</option>
                <option value="3" {{ request('category_id') == '3' ? 'selected' : '' }}>商品トラブル</option>
                <option value="4" {{ request('category_id') == '4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                <option value="5" {{ request('category_id') == '5' ? 'selected' : '' }}>その他</option>
            </select>
            <input type="date" name="created_at" class="Admin-search-date" value="{{ request('created_at') }}">
            <button type="submit" class="Admin-search-button">検索</button>
            <a href="{{ route('admin.index') }}" class="Admin-reset-button">リセット</a>
        </form>
    </div>
    <div class="Admin-container-export-pagination">
        <a href="/export" class="Admin-export-button">エクスポート</a>
        <div class="Admin-container-pagination">
        {{ $contacts->links() }}
        </div>
    </div>
    <table class="Admin-table">
        <thead class="Admin-table-header">
        <tr class="Admin-table-row">
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($contacts as $contact)
        <tr class="Admin-table-row">
            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
            <td>{{ $contact->gender == 0 ? '男性' : ($contact->gender == 1 ? '女性' : 'その他') }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->category->content ?? '' }}</td>
            <td>
                <button type="button" class="detail-btn"
                    data-id="{{ $contact->id }}"
                    data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                    data-gender="{{ $contact->gender == 0 ? '男性' : ($contact->gender == 1 ? '女性' : 'その他') }}"
                    data-email="{{ $contact->email }}"
                    data-tel="{{ $contact->tel }}"
                    data-address="{{ $contact->address }}"
                    data-building="{{ $contact->building }}"
                    data-category="{{ $contact->category->content ?? '' }}"
                    data-detail="{{ $contact->detail }}">詳細
                </button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{-- モーダル --}}
<div id="modal-overlay" class="modal-overlay" style="display:none;">
    <div class="modal">
        <button type="button" class="modal-close" id="modal-close">×</button>
        <table class="modal-table">
            <tr><th>お名前</th><td id="modal-name"></td></tr>
            <tr><th>性別</th><td id="modal-gender"></td></tr>
            <tr><th>メールアドレス</th><td id="modal-email"></td></tr>
            <tr><th>電話番号</th><td id="modal-tel"></td></tr>
            <tr><th>住所</th><td id="modal-address"></td></tr>
            <tr><th>建物名</th><td id="modal-building"></td></tr>
            <tr><th>お問い合わせの種類</th><td id="modal-category"></td></tr>
            <tr><th>お問い合わせ内容</th><td id="modal-detail"></td></tr>
        </table>
        <div class="modal-footer">
            <form method="POST" id="modal-delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="modal-delete-btn">削除</button>
            </form>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.detail-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('modal-name').textContent = this.dataset.name;
        document.getElementById('modal-gender').textContent = this.dataset.gender;
        document.getElementById('modal-email').textContent = this.dataset.email;
        document.getElementById('modal-tel').textContent = this.dataset.tel;
        document.getElementById('modal-address').textContent = this.dataset.address;
        document.getElementById('modal-building').textContent = this.dataset.building;
        document.getElementById('modal-category').textContent = this.dataset.category;
        document.getElementById('modal-detail').textContent = this.dataset.detail;
        document.getElementById('modal-delete-form').action = '/admin/' + this.dataset.id;
        document.getElementById('modal-overlay').style.display = 'flex';
    });
});

document.getElementById('modal-close').addEventListener('click', function() {
    document.getElementById('modal-overlay').style.display = 'none';
});

document.getElementById('modal-overlay').addEventListener('click', function(e) {
    if (e.target === this) {
        this.style.display = 'none';
    }
});
</script>

@endsection