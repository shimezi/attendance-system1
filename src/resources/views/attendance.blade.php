@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
    <div class="container">
        <div>
            <form action="{{ route('attendance') }}" method="GET" style="display:inline;">
                <input type="hidden" name="date" value="{{ $previousDate }}">
                <button type="submit">&lt;</button>
            </form>
            <span>日付: {{ $date }}</span>
            <form action="{{ route('attendance') }}" method="GET" style="display:inline;">
                <input type="hidden" name="date" value="{{ $nextDate }}">
                <button type="submit">&gt;</button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>名前</th>
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
                        <td>{{ $attendance->total_rest_time }}</td>
                        <td>{{ $attendance->total_attendance_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
