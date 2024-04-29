@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
    <div class="register-form">
        <div class="register-form__heading">
            <h2>会員登録</h2>
        </div>
        <div class="register-form__inner">
            <form class="register-form__form" action="/register" method="post">
                @csrf
                <div class="register-form__group">
                    <div class="register-form__group-title">
                        <span class="register-form__label==item">名前</span>
                    </div>
                    <div class="register-form__group-content">
                        <div class="register-form__input--text">
                            <input type="text" name="name" value="{{ old('name') }}" />
                        </div>
                        <div class="register-form__errot">
                            @error('name')
                                {{ message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="register-form__group">
                    <div class="register-form__group-title">
                        <span class="register-form__label--item">メールアドレス</span>
                    </div>
                    <div class="register-form__group-content">
                        <div class="register-form__input--text">
                            <input type="email" name="email" value="{{ old('email') }}" />
                        </div>
                        <div class="error">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="register-form__group">
                    <div class="register-form__group-title">
                        <span class="register-form__label--item">パスワード</span>
                    </div>
                    <div class="register-form_group-content">
                        <div class="register-form__input--text">
                            <input type="password" name="password" />
                        </div>
                        <div class="errot">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="register-form__group">
                    <div class="register-form__group-title">
                        <span class="register-form__label--item">確認用パスワード</span>
                    </div>
                    <div class="register-form__group-content">
                        <div class="register-form__input--text">
                            <input type="password" name="password_confirmation" />
                        </div>
                    </div>
                </div>
                <div class="register-form__button">
                    <button class="register-form__button-submit" type="submit">登録</button>
                </div>
            </form>
        </div>
        <div class="login__link">
            <p>アカウントをお持ちの方はこちらから</p>
            <a class="login__buton-submit" href="/login">ログイン</a>
        </div>
    </div>
@endsection
