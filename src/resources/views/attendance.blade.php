@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
    <div class="container">
        {{-- <h1>{{ $date->format('Y-m-d') }}</h1> --}}
        <a href="{{ route('attendance.show', ['date' => $date->subDay()->format('Y-m-d')]) }}">前</a>
        {{ $date->format('Y-m-d') }}
        <a href="{{ route('attendance.show', ['date' => $date->addDay()->format('Y-m-d')]) }}">次</a>
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
                        <td>{{ optional($attendance->start_time)->format('H:i:s') }}</td>
                        <td>{{ optional($attendance->end_time)->format('H:i:s') }}</td>
                        <td>{{ $attendance->rests->sum('duration') }}</td>
                        <td>{{ $attendance->totalWorkTime() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($attendances->count() > 0)
            <div class="pagination">
                {{ $attendances->links() }}
            </div>
        @else
            <p>No attendance records found.</p>
        @endif
    @endsection
