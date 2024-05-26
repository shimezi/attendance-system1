@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
    <div class="register-container">
        <h2>会員登録</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" id="name" name="name" placeholder="名前" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}"
                    required>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="パスワード" required>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="確認用パスワード"
                    required>
            </div>
            <button type="submit" class="btn-register">会員登録</button>
        </form>
        <p>アカウントをお持ちの方はこちらから</p>
        <a href="{{ route('login') }}" class="login-link">ログイン</a>
    </div>
@endsection
