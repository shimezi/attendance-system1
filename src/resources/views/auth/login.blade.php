@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
    <div class="login-form">
        <div class="login-form__heading">
            <h2>ログイン</h2>
        </div>
        <div class="login-form__inner">
            <form class="login-form__form" action="/login" method="post">
                @csrf
                <div class="login-form__group-content">
                    <div class="login-form__input--text">
                        <input type="email" name="email" value="{{ old('email') }}" />
                    </div>
                    <div class="login-form__error">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="login-form__group">
                    <div class="login-form__group-title">
                        <span class="login-form__group--item">パスワード</span>
                    </div>
                    <div class="login-form__group-content">
                        <div class="login-form__input==text">
                            <input type="password" name="pasword" />
                        </div>
                        <div class="login-form__error">
                            @error('passwprd')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="login-form__button">
                    <button class="login-form__button-submit" type="submit">ログイン</button>
                </div>
            </form>
            <div class="register__link">
                <a class="register__button-submit" href="/register">会員登録</a>
            </div>
        </div>
    @endsection
