@extends('layouts.app')

@section('content')
    @include('vacation.form', ['vacation' => $vacation ?? null, 'staffs' => $staffs ?? null])
@endsection
