@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <form action="/attendance/start_time" method="POST">
        @csrf
        <button type="submit">勤務開始</button>
    </form>
    <form action="/attendance/end_time" method="POST">
        @csrf
        <button type="submit">勤務終了</button>
    </form>
    <form action="/rest/start_time" method="POST">
        @csrf
        <button type="submit">休憩開始</button>
    </form>
    <form action="/rest/end_time" method="POST">
        @csrf
        <button type="submit">休憩終了</button>
    </form>
@endsection
