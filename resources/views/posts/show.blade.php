@extends('layouts.app')

@section('content')
<div class="bd-intro">
    <div class="d-md-flex align-items-center justify-content-between">
        <h1>게시판</h1>
    </div>
</div>

<div class="bd-content">
    <h1>{{ $post->title }}</h1>
    <div title="수정일 : {{ $post->updated_at }}">작성일: {{ $post->created_at }}</d></div>
    <div>작성자: {{ $post->author_name ?? '미정' }}</div>
    <div>{{ $post->content }}</div>
    
    <button type="button" class="btn btn-secondary" onclick="history.back()">목록으로</button>
    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">수정</a>
    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">삭제</button>
    </form>
</div>
@endsection
