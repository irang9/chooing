@extends('layouts.app')

@section('content')
    @include('users.form', ['user' => $user ?? null])
@endsection
