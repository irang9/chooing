@extends('layouts.app')

@section('content')

<div class="bd-intro">
    <div class="d-md-flex align-items-center justify-content-between">
        <h1>{{ isset($user) ? '사원 정보 수정' : '사원 정보 등록' }} < <a href="/users">사원 정보 관리</a></h1>
    </div>
</div>

<div class="bd-content">
    <form id="userForm" action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST">
        @csrf
        @if(isset($user))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label class="form-label">이름</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name ?? '' }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">직함</label>
            <input type="text" class="form-control" name="position" value="{{ $user->position ?? '' }}">
        </div>
        <div class="mb-3">
            <label class="form-label">생일</label>
            <input type="date" class="form-control" name="birthday" value="{{ $user->birthday ?? '' }}">
        </div>
        <div class="mb-3">
            <label class="form-label">휴대폰</label>
            <input type="text" class="form-control" name="phone_number" value="{{ $user->phone_number ?? '' }}">
        </div>
        <div class="mb-3">
            <label class="form-label">회사전화</label>
            <input type="text" class="form-control" name="company_phone" value="{{ $user->company_phone ?? '' }}">
        </div>
        <div class="mb-3">
            <label class="form-label">내선번호</label>
            <input type="text" class="form-control" name="extension" value="{{ $user->extension ?? '' }}">
        </div>
        <div class="mb-3">
            <label class="form-label">이메일</label>
            <input type="email" class="form-control" name="email" value="{{ $user->email ?? '' }}">
        </div>
        <div class="mb-3">
            <label class="form-label">입사일</label>
            <input type="date" class="form-control" name="hire_date" value="{{ $user->hire_date ?? '' }}">
        </div>
        @if(isset($user))
        <div class="mb-3">
            <label class="form-label">근속연수</label>
            <p>
                @php
                    $hireDate = new \Carbon\Carbon($user->hire_date);
                    $now = \Carbon\Carbon::now();
                    $years = $now->diffInYears($hireDate);
                    $months = $now->diffInMonths($hireDate) % 12;
                    echo "{$years}년 {$months}개월";
                @endphp
            </p>
        </div>
        @endif
        <div class="mb-3">
            <label class="form-label">상태</label>
            <div>
                <input type="radio" id="status_active" name="status" value="재직" {{ (isset($user) && $user->status == '재직') ? 'checked' : '' }}>
                <label for="status_active">재직</label>
                <input type="radio" id="status_outsource" name="status" value="외주" {{ (isset($user) && $user->status == '외주') ? 'checked' : '' }}>
                <label for="status_outsource">외주</label>
                <input type="radio" id="status_retired" name="status" value="퇴사" {{ (isset($user) && $user->status == '퇴사') ? 'checked' : '' }}>
                <label for="status_retired">퇴사</label>
                <input type="radio" id="status_other" name="status" value="기타" {{ (!isset($user) || $user->status == '기타') ? 'checked' : '' }}>
                <label for="status_other">기타</label>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">근무시간</label>
            <p>
                출근 <input type="time" id="start_time" name="start_time" value="{{ $user->start_time ?? '09:00' }}"> ~ 퇴근 <input type="time" id="end_time" name="end_time" value="{{ $user->end_time ?? '18:00' }}"> 
                <span id="total_hours"></span>, 주 <input type="number" id="work_days" name="work_days" value="{{ $user->work_days ?? '5' }}" min="1" max="7" step="0.5">일/<span id="weekly_hours"></span>
                <div>점심시간 : 11:20 ~ 12:20</div>
            </p>
        </div>
        <div class="mb-3">
            <label class="form-label">메모</label>
            <textarea class="form-control" name="memo" rows="3">{{ old('memo', $user->memo ?? '') }}</textarea>
        </div>

        <div class="buttons d-flex align-items-center justify-content-between gap-3">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">{{ isset($user) ? '목록으로' : '취소' }}</a>
            <button type="submit" class="btn btn-primary px-5 me-auto">저장</button>
            
            @if(isset($user))
                <button type="button" class="btn btn-danger btn-sm ms-auto" onclick="confirmDelete({{ $user->id }})">삭제</button>
            @endif
        </div>
    </form>
</div>

@if(isset($user))
<div class="mt-5">
    <h2>수정 기록</h2>
    <ul>
        @if($user->editHistory && $user->editHistory->isNotEmpty())
            @foreach($user->editHistory->sortByDesc('created_at') as $edit)
                <li>
                    {{ $edit->created_at->format('Y.m.d') }} ({{ ['일', '월', '화', '수', '목', '금', '토'][$edit->created_at->dayOfWeek] }}) {{ $edit->created_at->format('H:i') }} : 

                    @if($edit->type == 'work_time')
                        근무시간 : {{ $edit->old_value }} → {{ $edit->new_value }}
                    @elseif($edit->type == 'memo')
                        메모 : {{ $edit->old_value }} → {{ $edit->new_value }}
                    @else
                        {{ $edit->field }} : {{ $edit->old_value }} → {{ $edit->new_value }}
                    @endif
                </li>
            @endforeach
        @else
            <li>수정 기록이 없습니다.</li>
        @endif
    </ul>
</div>
@endif

@if(isset($user))
<!-- 삭제 확인 모달 -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                정말로 삭제합니까?
            </div>
            <div class="modal-footer"> 
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">삭제</button>
            </div>
        </div>
    </div>
</div>
@endif

@endsection