@extends('layouts.app')

@section('content')
<div class="container">
    <h1>사원 수정</h1>
    <form action="{{ route('staff.update', $staff->id) }}" method="POST">
        @method('PUT')
        @include('staff.form')
    </form>
</div>
@endsection
