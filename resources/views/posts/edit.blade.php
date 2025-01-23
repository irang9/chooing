@extends('layouts.app')

@section('content')
    @include('posts.form', ['post' => $post])
@endsection
