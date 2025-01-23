@extends('layouts.app')

@section('content')

    @include('vacation.form', ['vacation' => $vacation])

@endsection
