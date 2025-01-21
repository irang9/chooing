@extends('layouts.app')

<!-- @section('title', $employee->id ? '사원 정보' : '새 정보 입력') -->
@section('title', $employee ? '사원 정보' : '새 정보 입력')

@section('content')
    <!-- <h2>{{ $employee->id ? '사원 정보' : '새 정보 입력' }}</h2> -->
    <h2>{{ $employee ? '사원 정보' : '새 정보 입력' }}</h2>

    <form action="{{ $employee ? route('employees.update', $employee->id) : route('employees.store') }}" method="POST">
        @csrf
        @if($employee)
            @method('PUT')
        @endif
        
        <div class="mb-3">
            <label for="name" class="form-label">이름</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $employee->name) }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">휴대 전화번호</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $employee->phone) }}">
        </div>

        <div class="mb-3">
            <label for="company_phone" class="form-label">회사 전화번호</label>
            <input type="text" class="form-control" id="company_phone" name="company_phone" value="{{ old('company_phone', $employee->company_phone) }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">회사 이메일</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $employee->email) }}">
        </div>

        <div class="mb-3">
            <label for="hire_date" class="form-label">입사일</label>
            <input type="date" class="form-control" id="hire_date" name="hire_date" value="{{ old('hire_date', $employee->hire_date) }}">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">재직 상태</label>
            <select id="status" name="status" class="form-control">
                @foreach(App\Models\Employee::STATUS as $value => $label)
                    <option value="{{ $value }}" {{ old('status', $employee->status) == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach

            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ $employee->id ? '저장' : '등록' }}</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">목록으로</a>
    </form>
@endsection