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

    <table class="table">
        <thead>
            <tr>
                <th>제목</th>
                <th>작성일</th>
                <th>작성자</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
                <td title="수정일 : {{ $post->updated_at }}">{{ $post->created_at }}</td>
                <td>{{ $post->author_name ?? '미정' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
