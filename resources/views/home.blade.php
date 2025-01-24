@extends('layouts.app')

@section('content')
<div class="bd-intro">
    <div class="d-md-flex align-items-center justify-content-start">
        <h1>인트라넷 홈</h1>
        <div class="date ms-3">{{ \Carbon\Carbon::now()->locale('ko')->isoFormat('Y.MM.D(ddd)') }}</div>
    </div>
</div>

<div class="bd-content">
    <div id="calendar"></div>
</div>

<!-- FullCalendar 라이브러리 로드 -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [
            @if(is_array($vacations) || is_object($vacations))
                @foreach($vacations as $vacation)
                {
                    title: '{{ $vacation->type }} - {{ $vacation->user ? $vacation->user->name : 'Unknown' }} ({{ $vacation->duration }})',
                    start: '{{ $vacation->start_date }}',
                    end: '{{ $vacation->end_date }}',
                    url: '{{ route('vacations.show', $vacation->id) }}', // 라우트 복수형 유지
                    color: 'blue'
                },
                @endforeach
            @endif
            @if(is_array($users) || is_object($users))
                @foreach($users as $user)
                {
                    title: '입사일 - {{ $user->name }}',
                    start: '{{ $user->hire_date }}',
                    url: '{{ route('users.show', $user->id) }}', // 라우트 복수형 유지
                    color: 'green'
                },
                @endforeach
            @endif
        ],
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'today'
        },
        locale: 'ko'
    });
    calendar.render();
});
</script>
@endsection
