@extends('layouts.app')

@section('content')
<div class="container">
    <h1>사원 정보</h1>
    @include('staff.form', ['staff' => $staff ?? null])
    <form action="{{ route('staff.destroy', $staff->id ?? 0) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger d-block ms-auto" {{ isset($staff) ? '' : 'disabled' }}>삭제</button>
    </form>
    @if(isset($staff))
    <div class="mt-3">
        <h3>수정 기록</h3>
        <ul>
            @if($staff->editHistory)
                @foreach($staff->editHistory->sortByDesc('created_at') as $edit)
                    <li>
                        {{ $edit->created_at->format('Y.m.d(D) H:i') }} 
                        @if($edit->type == 'work_time')
                            근무시간 변경 {{ $edit->old_value }} -> {{ $edit->new_value }}
                        @elseif($edit->type == 'memo')
                            메모 내용 변경
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
</div>

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
@endsection
