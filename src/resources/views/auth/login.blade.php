@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('header_button')
<a href="/register" class="header-btn">register</a>
@endsection

@section('content')
<div class="login-container">
    <div class="login-container-title">Login</div>
    <form action="/login" method="POST" class="login-form">
        @csrf
        <div class="form-group">
            <div class="form-group-content">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" placeholder="例: test@example.com">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @endif
            </div>
            <div class="form-group-content">
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password" placeholder="例: coachtech1106">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @endif
            </div>
            <div class="form-group-button">
                <button type="submit" class="login-button">ログイン</button>
            </div>
        </div>
    </form>
</div>
@endsection
