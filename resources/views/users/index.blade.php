@extends('layouts.app')

@section('content')

<div class="bd-intro">
    <div class="d-md-flex flex-md-row-reverse align-items-center justify-content-between">
        <div class="mb-3 mb-md-0 d-flex text-nowrap"><a class="btn btn-sm btn-primary" href="{{ route('users.create') }}" title="사원 등록하기">
        사원 등록
        </a>
        </div>
        <h1>사원 정보</h1>
    </div>
</div>


<div class="bd-content">

    
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
            @foreach($users as $user)
            <tr>
                <td><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->company_phone }}</td>
                <td>{{ $user->extension }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->hire_date }}</td>
                <td>{{ $user->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
