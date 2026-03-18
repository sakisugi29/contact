@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('header_button')
<a href="/login" class="header-btn">login</a>
@endsection

@section('content')
<div class="registar-container">
    <div class="registar-container-title">Registar</div>
    <form action="/register" method="POST" class="registar-form">
        @csrf
        <div class="form-group">
            <div class="form-group-content">
                <label for="name">お名前</label>
                <input type="text" name="name" id="name" maxlength="8" placeholder="例: 山田 太郎"  value="{{ old('name') }}">
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group-content">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" placeholder="例:test@example.com"  value="{{ old('email') }}">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group-content">
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password" placeholder="例:coachtech1106"  value="{{ old('password') }}">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group-button">
                <button type="submit" class="register-button">登録</button>
            </div>
        </div>
    </form>
</div>
@endsection