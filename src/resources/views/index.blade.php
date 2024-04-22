@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="button-form">
        <ul>
            <li>
                <form action="{{ route('attendance/start_time') }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-primary">勤務開始</button>
                </form>
            </li>
            <li>
                <form action="{{ route('attendance/end_time') }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-success">勤務終了</button>
                </form>
            </li>
            <li>
                <form action="{{ route('rest/stard_time') }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-primary">休憩開始</button>
                </form>
            </li>
            <li>
                <form action="{{ route('rest/end_time') }}" method="POST">
                    @csrf
                    @method('POST')

                    <button type="submit" class="btn btn-success">休憩終了</button>
                </form>
            </li>
        </ul>
    </div>
@endsection
