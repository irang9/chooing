@extends('layouts.app')

@section('content')

<div class="bd-intro">
    <div class="d-md-flex align-items-center justify-content-between">
        <h1>{{ isset($staff) ? '사원 수정' : '사원 등록' }} < <a href="/staff">사원 관리</a></h1>
    </div>
</div>

<div class="bd-content">
    <form id="staffForm" action="{{ isset($staff) ? route('staff.update', $staff->id) : route('staff.store') }}" method="POST">
        @csrf
        @if(isset($staff))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label class="form-label">이름</label>
            <input type="text" class="form-control" name="name" value="{{ $staff->name ?? '' }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">직함</label>
            <input type="text" class="form-control" name="position" value="{{ $staff->position ?? '' }}">
        </div>
        <div class="mb-3">
            <label class="form-label">생일</label>
            <input type="date" class="form-control" name="birthday" value="{{ $staff->birthday ?? '' }}">
        </div>
        <div class="mb-3">
            <label class="form-label">휴대폰</label>
            <input type="text" class="form-control" name="phone" value="{{ $staff->phone ?? '' }}">
        </div>
        <div class="mb-3">
            <label class="form-label">회사전화</label>
            <input type="text" class="form-control" name="company_phone" value="{{ $staff->company_phone ?? '' }}">
        </div>
        <div class="mb-3">
            <label class="form-label">내선번호</label>
            <input type="text" class="form-control" name="extension" value="{{ $staff->extension ?? '' }}">
        </div>
        <div class="mb-3">
            <label class="form-label">이메일</label>
            <input type="email" class="form-control" name="email" value="{{ $staff->email ?? '' }}">
        </div>
        <div class="mb-3">
            <label class="form-label">입사일</label>
            <input type="date" class="form-control" name="hire_date" value="{{ $staff->hire_date ?? '' }}">
        </div>
        @if(isset($staff))
        <div class="mb-3">
            <label class="form-label">근속연수</label>
            <p>
                @php
                    $hireDate = new \Carbon\Carbon($staff->hire_date);
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
                <input type="radio" id="status_active" name="status" value="재직" {{ (isset($staff) && $staff->status == '재직') ? 'checked' : '' }}>
                <label for="status_active">재직</label>
                <input type="radio" id="status_outsource" name="status" value="외주" {{ (isset($staff) && $staff->status == '외주') ? 'checked' : '' }}>
                <label for="status_outsource">외주</label>
                <input type="radio" id="status_retired" name="status" value="퇴사" {{ (isset($staff) && $staff->status == '퇴사') ? 'checked' : '' }}>
                <label for="status_retired">퇴사</label>
                <input type="radio" id="status_other" name="status" value="기타" {{ (!isset($staff) || $staff->status == '기타') ? 'checked' : '' }}>
                <label for="status_other">기타</label>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">근무시간</label>
            <p>
                출근 <input type="time" id="start_time" name="start_time" value="09:00"> ~ 퇴근 <input type="time" id="end_time" name="end_time" value="18:00"> 
                <span id="total_hours"></span>, 주 <input type="number" id="work_days" name="work_days" value="5" min="1" max="7" step="0.5">일/<span id="weekly_hours"></span>
                <div>점심시간 : 11:20 ~ 12:20</div>
            </p>
        </div>
        <div class="mb-3">
            <label class="form-label">메모</label>
            <textarea class="form-control" name="memo" rows="3">{{ old('memo', $staff->memo ?? '') }}</textarea>
        </div>

        <div class="buttons d-flex align-items-center justify-content-between gap-3">
            <a href="{{ route('staff.index') }}" class="btn btn-secondary">{{ isset($staff) ? '목록으로' : '취소' }}</a>
            <button type="submit" class="btn btn-primary px-5 me-auto">저장</button>
            
            @if(isset($staff))
                <button type="button" class="btn btn-danger btn-sm ms-auto" onclick="confirmDelete({{ $staff->id }})">삭제</button>
            @endif
        </div>
    </form>
</div>

@if(isset($staff))
<div class="mt-5">
    <h2>수정 기록</h2>
    <ul>
        @if($staff->editHistory && $staff->editHistory->isNotEmpty())
            @foreach($staff->editHistory->sortByDesc('created_at') as $edit)
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

@if(isset($staff))
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function calculateHours() {
            const startTime = document.getElementById('start_time').value;
            const endTime = document.getElementById('end_time').value;
            const workDays = document.getElementById('work_days').value;
            const start = new Date(`1970-01-01T${startTime}:00`);
            const end = new Date(`1970-01-01T${endTime}:00`);
            const diff = (end - start) / (1000 * 60 * 60) - 1; // 점심시간 1시간 제외
            const weeklyHours = diff * workDays; // 선택한 근무일 기준

            document.getElementById('total_hours').textContent = `총 ${diff}시간`;
            document.getElementById('weekly_hours').textContent = `${weeklyHours}시간`;
        }

        document.getElementById('start_time').addEventListener('change', calculateHours);
        document.getElementById('end_time').addEventListener('change', calculateHours);
        document.getElementById('work_days').addEventListener('change', calculateHours);

        calculateHours(); // 초기 계산
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

    window.confirmDelete = function (id) {
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');
        confirmDeleteButton.onclick = function () {
            deleteModal.hide();
            alert('삭제되었습니다.');
            document.getElementById('deleteForm-' + id).submit();
        };
        deleteModal.show();
    };

    const staffForm = document.getElementById('staffForm');
    staffForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const message = '{{ isset($staff) ? "저장되었습니다." : "등록되었습니다." }}';
        alert(message);
        staffForm.submit();
        setTimeout(function() {
            window.location.href = '{{ route('staff.index') }}';
        }, 1000); // 1초 후 리다이렉트
    });
});
</script>

@endsection