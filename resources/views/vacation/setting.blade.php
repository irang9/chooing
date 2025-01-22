@extends('layouts.app')

@section('content')
<div class="container">
    <h1>휴가 시스템 설정</h1>
    <form action="{{ route('vacation.setting.save') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="annual_leave_days" class="form-label">연차 휴가 일수</label>
            <input type="number" class="form-control" id="annual_leave_days" name="annual_leave_days" value="{{ old('annual_leave_days', config('vacation.annual_leave_days', 15)) }}" required>
        </div>
        <div class="mb-3">
            <label for="half_day_hours" class="form-label">반차 시간</label>
            <input type="number" class="form-control" id="half_day_hours" name="half_day_hours" value="{{ old('half_day_hours', config('vacation.half_day_hours', 4)) }}" required>
        </div>
        <div class="mb-3">
            <label for="quarter_day_hours" class="form-label">반반차 시간</label>
            <input type="number" class="form-control" id="quarter_day_hours" name="quarter_day_hours" value="{{ old('quarter_day_hours', config('vacation.quarter_day_hours', 2)) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">저장</button>
    </form>
</div>
@endsection
