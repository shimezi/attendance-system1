@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1>日付別勤務管理表</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ユーザー名</th>
                    <th>勤務開始</th>
                    <th>勤務終了</th>
                    <th>休憩時間</th>
                    <th>勤務時間</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->user->name }}</td>
                        <td>{{ $attendance->start_time }}</td>
                        <td>{{ $attendance->end_time }}</td>
                        <td>{{ $attendance->rest_duration }}</td>
                        <td>{{ $attendance->work_duration }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
