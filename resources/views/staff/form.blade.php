<form action="{{ isset($staff) ? route('staff.update', $staff->id) : route('staff.store') }}" method="POST">
    @csrf
    @if(isset($staff))
        @method('PUT')
    @endif
    <div class="mb-3">
        <label class="form-label">이름</label>
        <input type="text" class="form-control" name="name" value="{{ $staff->name ?? '' }}">
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
        <input type="text" class="form-control" name="status" value="{{ $staff->status ?? '' }}">
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
    <button type="submit" class="btn btn-primary">저장</button>
    <a href="{{ route('staff.index') }}" class="btn btn-secondary">{{ isset($staff) ? '목록으로' : '취소' }}</a>
</form>
