@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <h1>Welcome, {{ Auth::user()->name }}!</h1>
    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif
    <form action="{{ route('attendance.start') }}" method="POST">
        @csrf
        <button type="submit">Start Work</button>
    </form>
    <form action="{{ route('attendance.end') }}" method="POST">
        @csrf
        <button type="submit">End Work</button>
    </form>
    <form action="{{ route('rest.start') }}" method="POST">
        @csrf
        <button type="submit">Start Rest</button>
    </form>
    <form action="{{ route('rest.end') }}" method="POST">
        @csrf
        <button type="submit">End Rest</button>
    </form>
@endsection
