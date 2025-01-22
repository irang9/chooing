@extends('layouts.app')

@section('content')
<div class="container">
    <h1>사원 정보</h1>
    <div class="mb-3">
        <label class="form-label">이름</label>
        <p>{{ $staff->name }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">휴대폰</label>
        <p>{{ $staff->phone }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">회사전화</label>
        <p>{{ $staff->company_phone }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">내선번호</label>
        <p>{{ $staff->extension }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">이메일</label>
        <p>{{ $staff->email }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">입사일</label>
        <p>{{ $staff->hire_date }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">상태</label>
        <p>{{ $staff->status }}</p>
    </div>
    <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-warning">수정</a>
    <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">삭제</button>
    </form>
    <a href="{{ route('staff.index') }}" class="btn btn-secondary">목록으로</a>
</div>
@endsection
