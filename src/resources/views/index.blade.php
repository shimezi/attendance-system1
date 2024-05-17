@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <h1>{{ Auth::user()->name }}さんお疲れ様です</h1>
    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif
    <form action="{{ route('attendance.start') }}" method="POST">
        @csrf
        <button type="submit">勤務開始</button>
    </form>
    <form action="{{ route('attendance.end') }}" method="POST">
        @csrf
        <button type="submit">勤務終了</button>
    </form>
    <form action="{{ route('rest.start') }}" method="POST">
        @csrf
        <button type="submit">休憩開始</button>
    </form>
    <form action="{{ route('rest.end') }}" method="POST">
        @csrf
        <button type="submit">休憩終了</button>
    </form>
@endsection
