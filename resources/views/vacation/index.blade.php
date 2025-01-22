@extends('layouts.app')

@section('content')
<div class="container">
    <h1>휴가 관리</h1>
    <div class="mb-3">
        <a href="{{ route('vacation.create') }}" class="btn btn-primary">휴가 등록</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>이름</th>
                <th>휴가 종류</th>
                <th>시작일</th>
                <th>사용일수/시간</th>
                <th>남은 연차</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vacations as $vacation)
            <tr>
                <td><a href="{{ route('vacation.edit', $vacation->id) }}">홍길동</a></td>
                <td>{{ $vacation->type }}</td>
                <td>{{ $vacation->start_date }}</td>
                <td>
                    @if($vacation->type == '연차' || $vacation->type == '경조사')
                        {{ \Carbon\Carbon::parse($vacation->start_date)->diffInDays(\Carbon\Carbon::parse($vacation->end_date)) + 1 }}일
                    @elseif($vacation->type == '반차')
                        4시간
                    @elseif($vacation->type == '반반차')
                        2시간
                    @endif
                </td>
                <td>{{ $vacation->remaining_days }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
        <a href="{{ route('vacation.setting') }}" class="btn btn-secondary">휴가 시스템 설정</a>
    </div>
</div>
@endsection
