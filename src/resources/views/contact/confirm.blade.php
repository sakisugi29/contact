@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <div class="confirm-container-title">Confirm</div>
    <div class="confirm-content">
        <form class="confirm-form" action="/store" method="POST">
            @csrf
            <div class="confirm-item">
                <label>お名前</label>
                <div class="confirm-value">{{ $inputs['last_name'] }} {{ $inputs['first_name'] }}</div>
                <input type="hidden" name="last_name" value="{{ $inputs['last_name'] }}">
                <input type="hidden" name="first_name" value="{{ $inputs['first_name'] }}">
            </div>
            <div class="confirm-item">
                <label>性別</label>
                <div class="confirm-value">{{ $genderLabel }}</div>
                <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">
            </div>
            <div class="confirm-item">
                <label>メールアドレス</label>
                <div class="confirm-value">{{ $inputs['email'] }}</div>
                <input type="hidden" name="email" value="{{ $inputs['email'] }}">
            </div>
            <div class="confirm-item">
                <label>電話番号</label>
                <div class="confirm-value">{{ $inputs['tel'] }}</div>
                <input type="hidden" name="tel1" value="{{ $inputs['tel1'] }}">
                <input type="hidden" name="tel2" value="{{ $inputs['tel2'] }}">
                <input type="hidden" name="tel3" value="{{ $inputs['tel3'] }}">
            </div>
            <div class="confirm-item">
                <label>住所</label>
                <div class="confirm-value">{{ $inputs['address'] }}</div>
                <input type="hidden" name="address" value="{{ $inputs['address'] }}">
            </div>
            <div class="confirm-item">
                <label>建物名</label>
                <div class="confirm-value">{{ $inputs['building'] ?: '指定なし' }}</div>
                <input type="hidden" name="building" value="{{ $inputs['building']}}">
            </div>
            <div class="confirm-item">
                <label>お問い合わせの種類</label>
                <div class="confirm-value">{{ $category->content ?? '' }}</div>
                <input type="hidden" name="category_id" value="{{ $category->id ?? '' }}">
            </div>
            <div class="confirm-item">
                <label>お問い合わせ内容</label>
                <div class="confirm-value">{{ $inputs['detail'] }}</div>
                <input type="hidden" name="detail" value="{{ $inputs['detail'] }}">
            </div>
            <div class="confirm-buttons">
                <button type="submit" name="action" value="submit">送信</button>
                <button type="submit" name="action" value="back">修正</button>
            </div>
        </form>
    </div>
</div>
@endsection