@extends('layouts.app')

@section('content')
    @include('staff.form', ['staff' => $staff ?? null])
@endsection
