@extends('layouts.app')

@section('content')
<div class="container">
    <h1>휴가 정보</h1>
    <div class="mb-3">
        <label for="type" class="form-label">휴가 종류</label>
        <input type="text" class="form-control" id="type" name="type" value="{{ $vacation->type }}" readonly>
    </div>
    <div class="mb-3">
        <label for="start_date" class="form-label">시작일</label>
        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $vacation->start_date }}" readonly>
    </div>
    <div class="mb-3">
        <label for="end_date" class="form-label">종료일</label>
        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $vacation->end_date }}" readonly>
    </div>
    <div class="mb-3">
        <label for="memo" class="form-label">메모</label>
        <textarea class="form-control" id="memo" name="memo" readonly>{{ $vacation->memo }}</textarea>
    </div>
    <a href="{{ route('vacation.index') }}" class="btn btn-secondary">목록으로</a>
</div>
@endsection
