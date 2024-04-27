@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
    <div class="attendance-table">
        <table class="attendance-table__inner">
            <tr class="attendance-table__row">
                <th class="attendance-table__header">名前</th>
                <th class="attendance-table__header">勤務開始</th>
                <th class="attendance-table__header">勤務終了</th>
                <th class="attendance-table__header">休憩時間</th>
                <th class="attendance-table__header">勤務時間</th>
            </tr>
            <tr class="attendance-table__row">
                <td class="attendance-table__item">テスト太郎</td>
                <td class="attendance-table__item"></td>
                <td class="attendance-table__item"></td>
                <td class="attendance-table__item"></td>
                <td class="attendance-table__item"></td>
            </tr>
            
        </table>
    </div>
@endsection
