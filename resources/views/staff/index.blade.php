@extends('layouts.app')

@section('content')
<div class="container">
    <h1>사원 목록</h1>
    <a href="{{ route('staff.create') }}" class="btn btn-primary">사원 추가</a>
    <table class="table">
        <thead>
            <tr>
                <th>이름</th>
                <th>휴대폰</th>
                <th>회사전화</th>
                <th>내선번호</th>
                <th>이메일</th>
                <th>입사일</th>
                <th>상태</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staff as $member)
            <tr>
                <td><a href="{{ route('staff.show', $member->id) }}">{{ $member->name }}</a></td>
                <td>{{ $member->phone }}</td>
                <td>{{ $member->company_phone }}</td>
                <td>{{ $member->extension }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->hire_date }}</td>
                <td>{{ $member->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
