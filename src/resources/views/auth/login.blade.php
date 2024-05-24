@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>ログイン</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">ログイン</button>
        </form>
        <p>アカウントをお持ちでない方はこちらから</p>
        <a href="{{ route('register') }}">
            <button>会員登録</button>
        </a>
    </div>
@endsection
