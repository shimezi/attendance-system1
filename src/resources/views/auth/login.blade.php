@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
    <div class="login__content">
        <div class="login-form__heading">
            <h2>ログイン</h2>
        </div>
        <form class="form">
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label==item">メールアドレス</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="email" name="email" value="{{ old('email') }}" />
                    </div>
                    <div class="form__error">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__group--item">パスワード</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input==text">
                        <input type="password" name="pasword" />
                    </div>
                    <div class="form__error">
                        @error('passwprd')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">ログイン</button>
            </div>
        </form>
        <div class="register__link">
            <a class="register__button-submit" href="/register">会員登録</a>
        </div>
    </div>
@endsection
