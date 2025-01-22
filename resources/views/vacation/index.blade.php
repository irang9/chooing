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
                <th>휴가 종류</th>
                <th>시작일</th>
                <th>종료일</th>
                <th>상태</th>
                <th>관리</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vacations as $vacation)
            <tr>
                <td>{{ $vacation->type }}</td>
                <td>{{ $vacation->start_date }}</td>
                <td>{{ $vacation->end_date }}</td>
                <td>{{ $vacation->status }}</td>
                <td>
                    <a href="{{ route('vacation.edit', $vacation->id) }}" class="btn btn-warning btn-sm">수정</a>
                    <form action="{{ route('vacation.destroy', $vacation->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">삭제</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
