@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
    <h1>User Attendance Records</h1>
    <ul>
        @foreach ($attendances as $attendance)
            <li>{{ $attendance->date }}: Start at {{ $attendance->start_time }} - End at
                {{ $attendance->end_time ?? 'Still working' }}</li>
        @endforeach
    </ul>
@endsection
