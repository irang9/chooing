@extends('layouts.app')

@section('content')
    @include('posts.form', ['post' => new \App\Models\Post])
    
@endsection
