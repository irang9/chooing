@extends('layouts.app')

@section('content')
<div class="container">
    <h1>휴가 등록</h1>
    <form id="vacationForm" action="{{ route('vacation.store') }}" method="POST">
        @csrf
        @include('vacation.form')
        <button type="submit" class="btn btn-primary">등록</button>
        <a href="{{ route('vacation.index') }}" class="btn btn-secondary">취소</a>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="validationModal" tabindex="-1" aria-labelledby="validationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="validationModalLabel">알림</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalMessage">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>

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
    const modalMessage = document.getElementById('modalMessage');
    const validationModal = new bootstrap.Modal(document.getElementById('validationModal'));
    const startDateDisplay = document.getElementById('start_date_display');
    const endDateDisplay = document.getElementById('end_date_display');

    typeRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (this.value === '연차' || this.value === '경조사') {
                startTimeContainer.style.display = 'none';
                endTimeContainer.style.display = 'none';
                endDateContainer.style.display = 'block';
                startDateInput.readOnly = false;
                endDateInput.readOnly = false;
                startDateInput.value = '{{ date('Y-m-d') }}';
                endDateInput.value = '{{ date('Y-m-d') }}';
                endDateInput.min = startDateInput.value;
                endDateInput.max = new Date(new Date(startDateInput.value).setMonth(new Date(startDateInput.value).getMonth() + 1)).toISOString().split('T')[0];
                updateVacationDays();
            } else {
                startTimeContainer.style.display = 'block';
                endTimeContainer.style.display = 'block';
                endDateContainer.style.display = 'none';
                startDateInput.readOnly = false;
                endDateInput.readOnly = true;
                startDateInput.value = '{{ date('Y-m-d') }}';
                endDateInput.value = startDateInput.value;
                startTimeInput.value = '09:00';
                updateVacationHours();
            }
        });
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
            modalMessage.textContent = '등록 내용을 다시 확인해주세요.';
            modalMessage.style.color = 'red';
            validationModal.show();
        } else {
            modalMessage.textContent = '등록 되었습니다.';
            modalMessage.style.color = 'black';
            validationModal.show();
            validationModal._element.addEventListener('hidden.bs.modal', function () {
                vacationForm.submit();
            }, { once: true });
        }
    });

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
    if (document.querySelector('input[name="type"]:checked').value === '연차' || document.querySelector('input[name="type"]:checked').value === '경조사') {
        updateVacationDays();
    } else {
        updateVacationHours();
    }
});
</script>
@endsection
