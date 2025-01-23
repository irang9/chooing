@extends('layouts.app')

@section('content')

@include('vacation.form', ['vacation' => $vacation])

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

@endsection
