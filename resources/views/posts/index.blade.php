@extends('layouts.app')

@section('content')

<div class="bd-intro">
    <div class="d-md-flex flex-md-row-reverse align-items-center justify-content-between">
        <div class="mb-3 mb-md-0 d-flex text-nowrap"><a class="btn btn-sm btn-primary rounded-2" href="{{ route('posts.create') }}" title="새 글 쓰기">
        새 글 쓰기
        </a>
        </div>
        <h1>게시판</h1>
    </div>
</div>


<div class="bd-content">
    <ul>
        @foreach ($posts as $post)
            <li>
                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                <span>{{ $post->created_at->format('Y-m-d H:i') }}</span>
                <span>작성자: {{ $post->author_name ?? '미정' }}</span>
            </li>
        @endforeach
    </ul>
</div>
@endsection
