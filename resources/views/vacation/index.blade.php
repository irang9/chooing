@extends('layouts.app')

@section('content')
<div class="bd-intro">
    <div class="d-md-flex flex-md-row-reverse align-items-center justify-content-between">
        <div class="mb-3 mb-md-0 d-flex text-nowrap"><a class="btn btn-sm btn-primary rounded-2" href="{{ route('vacation.create') }}" title="휴가 등록">
        휴가 등록
        </a>
        </div>
        <h1>휴가 관리</h1>
    </div>
</div>

<div class="bd-content">
    <table class="table">
        <thead>
            <tr>
                <th>사원 이름</th>
                <th>휴가 종류</th>
                <th>휴가 기간</th>
                <th>사용 일수</th>
                <th>남은 일수</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vacations as $vacation)
            <tr>
                <td><a href="{{ route('vacation.show', $vacation->id) }}">{{ $vacation->staff->name ?? 'Unknown' }}</a></td>
                <td>{{ $vacation->type}}</td>
                <td>{{ $vacation->start_date }} ~ {{ $vacation->end_date }} (이번 사용 일수일)</td>
                <td>총 사용 일수</td>
                <td>남은 일수</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
