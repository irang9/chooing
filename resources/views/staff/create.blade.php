@extends('layouts.app')

@section('content')
<div class="container">
    <h1>사원 추가</h1>
    <form action="{{ route('staff.store') }}" method="POST">
        @include('staff.form')
    </form>
</div>
@endsection
