@extends('layouts.app')

@section('content')

<div class="bd-intro">
    <div class="d-md-flex align-items-center justify-content-between">
        <h1>{{ isset($vacation) ? '휴가 수정' : '휴가 등록' }} < <a href="/vacation">휴가 관리</a></h1>
    </div>
</div>

<div class="bd-content">
    <form id="vacationForm" action="{{ isset($vacation) ? route('vacation.update', $vacation->id) : route('vacation.store') }}" method="POST">
        @csrf
        @if(isset($vacation))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label for="staff_id" class="form-label">사원 이름:</label>
            <select class="form-control" id="staff_id" name="staff_id" required>
                @foreach($staffs as $staff)
                    <option value="{{ $staff->id }}" {{ isset($vacation) && $vacation->staff_id == $staff->id ? 'selected' : '' }}>
                        {{ $staff->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="vacation_days" class="form-label">휴가 일수:</label>
            <span id="vacation_days">14일 (나중에 휴가 일수 계산식 넣어서 표기할 것)</span>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">휴가 종류</label><br>
            <input type="radio" id="annual" name="type" value="연차" required {{ isset($vacation) && $vacation->type == '연차' ? 'checked' : '' }}>
            <label for="annual">연차</label><br>
            <input type="radio" id="half" name="type" value="반차" required {{ isset($vacation) && $vacation->type == '반차' ? 'checked' : '' }}>
            <label for="half">반차</label><br>
            <input type="radio" id="quarter" name="type" value="반반차" required {{ isset($vacation) && $vacation->type == '반반차' ? 'checked' : '' }}>
            <label for="quarter">반반차</label><br>
            <input type="radio" id="event" name="type" value="경조사" required {{ isset($vacation) && $vacation->type == '경조사' ? 'checked' : '' }}>
            <label for="event">경조사</label>
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">시작일 <span id="start_date_display"></span></label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ isset($vacation) ? $vacation->start_date : date('Y-m-d') }}" min="{{ date('Y-m-d') }}" required>
        </div>
        <div class="mb-3" id="start_time_container" style="display:none;">
            <label for="start_time" class="form-label">시작 시간</label>
            <input type="time" class="form-control" id="start_time" name="start_time" step="1800" min="06:00" max="20:00" value="{{ isset($vacation) ? $vacation->start_time : '09:00' }}">
        </div>
        <div class="mb-3" id="end_date_container">
            <label for="end_date" class="form-label">종료일 <span id="end_date_display"></span></label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ isset($vacation) ? $vacation->end_date : date('Y-m-d') }}" min="{{ date('Y-m-d') }}" required>
        </div>
        <div class="mb-3" id="end_time_container" style="display:none;">
            <label for="end_time" class="form-label">종료 시간</label>
            <input type="time" class="form-control form-control-plaintext" id="end_time" name="end_time" readonly>
        </div>
        <div class="mb-3">
            <label for="vacation_duration" class="form-label">사용 예정:</label>
            <span id="vacation_duration"></span>
        </div>
        <div class="mb-3">
            <label for="memo" class="form-label">메모</label>
            <textarea class="form-control" id="memo" name="memo">{{ isset($vacation) ? $vacation->memo : '' }}</textarea>
        </div>

        <div class="buttons d-flex align-items-center justify-content-between gap-3">
            <a href="{{ route('vacation.index') }}" class="btn btn-secondary">{{ isset($vacation) ? '목록으로' : '취소' }}</a>
            <button type="submit" class="btn btn-primary px-5 me-auto">{{ isset($vacation) ? '저장' : '등록' }}</button>
            
            @if(isset($vacation))
                <button type="button" class="btn btn-danger btn-sm ms-auto" onclick="confirmDelete({{ $vacation->id }})">삭제</button>
            @endif
        </div>

    </form>
</div>

@if(isset($vacation))
<div class="mt-5">
    <h2>수정 기록</h2>
    <ul>
        @if($vacation->histories->isNotEmpty())
            @foreach($vacation->histories->sortByDesc('created_at') as $edit)
                <li>
                    {{ $edit->created_at->format('Y.m.d(D) H:i') }}
                    @if($edit->field == 'type')
                        휴가 종류 변경 : {{ $edit->new_value }}
                    @elseif($edit->field == 'start_date')
                        휴가 시작일 변경 : {{ $edit->new_value }}
                    @elseif($edit->field == 'memo')
                        메모 내용 변경 : {{ $edit->new_value }}
                    @else
                        {{ $edit->field }} 변경 {{ $edit->old_value }} → {{ $edit->new_value }}
                    @endif
                </li>
            @endforeach
        @else
            <li>수정 기록이 없습니다.</li>
        @endif
    </ul>
</div>
@endif

<!-- 삭제 확인 모달 -->
@if(isset($vacation))
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
document.addEventListener('DOMContentLoaded', function () {
    const typeRadios = document.querySelectorAll('input[name="type"]');
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    const startTimeContainer = document.getElementById('start_time_container');
    const endDateContainer = document.getElementById('end_date_container');
    const endTimeContainer = document.getElementById('end_time_container');
    const startTimeInput = document.getElementById('start_time');
    const endTimeInput = document.getElementById('end_time');
    const vacationDuration = document.getElementById('vacation_duration');
    const vacationForm = document.getElementById('vacationForm');
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const startDateDisplay = document.getElementById('start_date_display');
    const endDateDisplay = document.getElementById('end_date_display');

    function updateFormFields() {
        const selectedType = document.querySelector('input[name="type"]:checked').value;
        if (selectedType === '연차' || selectedType === '경조사') {
            startTimeContainer.style.display = 'none';
            endTimeContainer.style.display = 'none';
            endDateContainer.style.display = 'block';
            startDateInput.readOnly = false;
            endDateInput.readOnly = false;
            endDateInput.min = startDateInput.value;
            endDateInput.max = new Date(new Date(startDateInput.value).setMonth(new Date(startDateInput.value).getMonth() + 1)).toISOString().split('T')[0];
            updateVacationDays();
        } else {
            startTimeContainer.style.display = 'block';
            endTimeContainer.style.display = 'block';
            endDateContainer.style.display = 'none';
            startDateInput.readOnly = false;
            endDateInput.readOnly = true;
            endDateInput.value = startDateInput.value;
            startTimeInput.value = '09:00';
            updateVacationHours();
        }
    }

    typeRadios.forEach(radio => {
        radio.addEventListener('change', updateFormFields);
    });

    startDateInput.addEventListener('change', function () {
        updateDateDisplay(startDateInput, startDateDisplay);
        if (document.querySelector('input[name="type"]:checked').value === '연차' || document.querySelector('input[name="type"]:checked').value === '경조사') {
            endDateInput.min = startDateInput.value;
            endDateInput.max = new Date(new Date(startDateInput.value).setMonth(new Date(startDateInput.value).getMonth() + 1)).toISOString().split('T')[0];
            updateVacationDays();
        } else {
            endDateInput.value = startDateInput.value;
            updateVacationHours();
        }
    });

    endDateInput.addEventListener('change', function () {
        updateDateDisplay(endDateInput, endDateDisplay);
        if (document.querySelector('input[name="type"]:checked').value === '연차' || document.querySelector('input[name="type"]:checked').value === '경조사') {
            updateVacationDays();
        }
    });

    startTimeInput.addEventListener('change', updateVacationHours);

    vacationForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);
        const startTime = startTimeInput.value ? new Date(startDateInput.value + 'T' + startTimeInput.value) : null;
        const endTime = endTimeInput.value ? new Date(startDateInput.value + 'T' + endTimeInput.value) : null;

        if ((startTime && endTime && startTime > endTime) || startDate > endDate) {
            alert('등록 내용을 다시 확인해주세요.');
        } else {
            const message = '{{ isset($vacation) ? "저장되었습니다." : "등록되었습니다." }}';
            alert(message);
            vacationForm.submit();
        }
    });

    window.confirmDelete = function (id) {
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');
        confirmDeleteButton.onclick = function () {
            deleteModal.hide();
            alert('삭제되었습니다.');
            document.getElementById('deleteForm-' + id).submit();
        };
        deleteModal.show();
    };

    function updateVacationDays() {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);
        const diffTime = endDate - startDate;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
        if (diffTime < 0) {
            vacationDuration.textContent = `-${Math.abs(diffDays)}일`;
            vacationDuration.style.color = 'red';
        } else {
            vacationDuration.textContent = `${diffDays}일`;
            vacationDuration.style.color = 'black';
        }
    }

    function updateVacationHours() {
        const startDate = new Date(startDateInput.value + 'T' + startTimeInput.value);
        let endDate = new Date(startDate);
        if (document.querySelector('input[name="type"]:checked').value === '반차') {
            endDate.setHours(startDate.getHours() + 4);
        } else if (document.querySelector('input[name="type"]:checked').value === '반반차') {
            endDate.setHours(startDate.getHours() + 2);
        }
        endTimeInput.value = endDate.toTimeString().slice(0, 5);
        const diffTime = endDate - startDate;
        const diffHours = Math.floor(diffTime / (1000 * 60 * 60));
        const diffMinutes = Math.floor((diffTime % (1000 * 60 * 60)) / (1000 * 60));
        if (diffTime < 0) {
            vacationDuration.textContent = `-${Math.abs(diffHours)}시간 ${Math.abs(diffMinutes)}분`;
            vacationDuration.style.color = 'red';
        } else {
            vacationDuration.textContent = `${diffHours}시간 ${diffMinutes}분`;
            vacationDuration.style.color = 'black';
        }
    }

    function updateDateDisplay(dateInput, displayElement) {
        const date = new Date(dateInput.value);
        const options = { year: 'numeric', month: '2-digit', day: '2-digit', weekday: 'short' };
        displayElement.textContent = date.toLocaleDateString('ko-KR', options).replace(/ /g, '').replace(',', '');
    }

    // 초기화
    updateDateDisplay(startDateInput, startDateDisplay);
    updateDateDisplay(endDateInput, endDateDisplay);
    updateFormFields();
});
</script>

@endsection