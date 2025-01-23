@extends('layouts.app')

@section('content')

@include('staff.form', ['staff' => $staff ?? null])

<div class="mt-5">
    <h2>수정 기록</h2>
    <ul>
        @if($staff->editHistory)
            @foreach($staff->editHistory->sortByDesc('created_at') as $edit)
                <li>
                    {{ $edit->created_at->format('Y.m.d(D) H:i') }} 
                    @if($edit->type == 'work_time')
                        근무시간 변경 {{ $edit->old_value }} -> {{ $edit->new_value }}
                    @elseif($edit->type == 'memo')
                        메모 내용 변경 {{ $edit->old_value }} -> {{ $edit->new_value }}
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

@endsection
