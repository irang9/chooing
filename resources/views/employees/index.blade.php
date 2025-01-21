<!-- resources/views/employees/index.blade.php -->
@extends('layouts.app')

@section('title', '사원 목록')

@section('content')

        <h2>사원 목록</h2>
        <a href="{{ route('employees.view', ['id' => 'new']) }}" class="btn btn-primary mb-3">새 정보 입력</a>
        <!-- <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">새 정보 입력</a> -->
        <table class="table">
            <thead>
                <tr>
                    <th>이름</th>
                    <th>휴대 전화번호</th>
                    <th>회사 이메일</th>
                    <th>입사일</th>
                    <th>재직상태</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td><a href="{{ route('employees.view', $employee->id) }}">{{ $employee->name }}</a></td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->hire_date }}</td>
                        <td>{{ $employee->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        

@endsection
