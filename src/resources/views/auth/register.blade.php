@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>ユーザー登録</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div>
                <label for="name">名前</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="password_confirmation">パスワード確認</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit">登録</button>
        </form>
    </div>
@endsection

