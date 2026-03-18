@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="contact-container">
    <div class="contact-container-title">Contact</div>
    <form action="/confirm" method="POST" class="contact-form" >
        @csrf
        <div class="form-group">
            <div class="form-group-content">
                <label >お名前<span>※</span></label>
                <input type="text" name="last_name" maxlength="8" placeholder="例: 山田"  value="{{ old('last_name') }}">
                <input type="text" name="first_name" maxlength="8" placeholder="例: 太郎"  value="{{ old('first_name') }}">
                @if ($errors->has('last_name') || $errors->has('first_name'))
                    <div class="error-message">
                        {{ $errors->first('last_name') }} {{ $errors->first('first_name') }}
                    </div>
                @endif
            </div>
            <div class="form-group-content">
                <label>性別<span>※</span></label>
                <input type="radio" name="gender" value="0"  {{ old('gender') === '0' ? 'checked' : '' }}>男性
                <input type="radio" name="gender" value="1"  {{ old('gender') === '1' ? 'checked' : '' }}>女性
                <input type="radio" name="gender" value="2"  {{ old('gender') === '2' ? 'checked' : '' }}>その他
                @if ($errors->has('gender'))
                    <div class="error-message">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
            </div>
            <div class="form-group-content">
                <label>メールアドレス<span>※</span></label>
                <input type="email" name="email" placeholder="例: test@example.com"  value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <div class="error-message">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="form-group-content">
                <label>電話番号<span>※</span></label>
                <input type="tel" maxlength="3" name="tel1" placeholder="080"  value="{{ old('tel1') }}">-
                <input type="tel" maxlength="4" name="tel2" placeholder="1234"  value="{{ old('tel2') }}">-
                <input type="tel" maxlength="4" name="tel3" placeholder="5678"  value="{{ old('tel3') }}">
                @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                    <div class="error-message">
                        {{ $errors->first('tel1') ?: ($errors->first('tel2') ?: $errors->first('tel3')) }}
                    </div>
                @endif
            </div>
            <div class="form-group-content">
                <label>住所<span>※</span></label>
                <input type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3"  value="{{ old('address') }}">
                @if ($errors->has('address'))
                    <div class="error-message">
                        {{ $errors->first('address') }}
                    </div>
                @endif
            </div>
            <div class="form-group-content">
                <label>建物名</label>
                <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101" value="{{ old('building') }}">
            </div>
            <div class="form-group-content">
                <label>お問い合わせの種類<span>※</span></label>
                <select name="category_id" >
                    <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>選択してください</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->content }}</option>
                    @endforeach
                </select>
                @if ($errors->has('category_id'))
                    <div class="error-message">
                        {{ $errors->first('category_id') }}
                    </div>
                @endif
            </div>
            <div class="form-group-content">
                <label>お問い合わせ内容<span>※</span></label>
                <textarea name="detail" maxlength="120" placeholder="お問い合わせ内容を入力してください" >{{ old('detail') }}</textarea>
                @if ($errors->has('detail'))
                    <div class="error-message">
                        {{ $errors->first('detail') }}
                    </div>
                @endif
            </div>
            <div class="form-group-content">
                <button type="submit">確認画面</button>
            </div>
        </div>
    </form>
</div>
@endsection