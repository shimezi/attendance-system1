@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="container-wrapper">
        <div class="container">
            @if (Auth::check())
                <p class="user-greeting">{{ Auth::user()->name }}さんお疲れ様です！</p>
            @endif
            <div class="button-grid">
                <form action="{{ route('attendance.start') }}" method="POST">
                    @csrf
                    <button type="submit" class="clock-button" {{ $canStartAttendance ? '' : 'disabled' }}>勤務開始</button>
                </form>
                <form action="{{ route('attendance.end') }}" method="POST">
                    @csrf
                    <button type="submit" class="clock-button" {{ $canEndAttendance ? '' : 'disabled' }}>勤務終了</button>
                </form>
                <form action="{{ route('rest.start') }}" method="POST">
                    @csrf
                    <button type="submit" class="clock-button" {{ $canStartRest ? '' : 'disabled' }}>休憩開始</button>
                </form>
                <form action="{{ route('rest.end') }}" method="POST">
                    @csrf
                    <button type="submit" class="clock-button" {{ $canEndRest ? '' : 'disabled' }}>休憩終了</button>
                </form>
            </div>
        </div>
    </div>
@endsection
