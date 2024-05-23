@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>勤務管理</h2>
        <div class="button-group">
            <form action="{{ route('attendance.start') }}" method="POST">
                @csrf
                <button type="submit" {{ $canStartAttendance ? '' : 'disabled' }}>勤務開始</button>
            </form>
            <form action="{{ route('attendance.end') }}" method="POST">
                @csrf
                <button type="submit" {{ $canEndAttendance ? '' : 'disabled' }}>勤務終了</button>
            </form>
            <form action="{{ route('rest.start') }}" method="POST">
            @csrf
            <button type="submit" {{ $canStartRest ? '' : 'disabled' }}>休憩開始</button>
            </form>
            <form action="{{ route('rest.end') }}" method="POST">
            @csrf
            <button type="submit" {{ $canEndRest ? '' : 'disabled' }}>休憩終了</button>
            </form>
        </div>
    </div>
@endsection
