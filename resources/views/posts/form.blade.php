@extends('layouts.app')

@section('content')

<div class="bd-intro">
    <div class="d-md-flex align-items-center justify-content-between">
        <h1>{{ isset($post->id) ? '글 수정' : '새 글 쓰기' }} < 게시판</h1>
    </div>
</div>


<div class="bd-content">
<form action="{{ isset($post->id) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST">
    @csrf
    @if(isset($post->id))
        @method('PUT')
    @endif
    <div>
        <label for="title">제목</label>
        <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}">
    </div>
    <div>
        <label for="content">내용</label>
        <textarea id="content" name="content">{{ old('content', $post->content) }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">{{ isset($post->id) ? '수정 저장' : '작성 완료' }}</button>
    <button type="button" class="btn btn-secondary" onclick="history.back()">취소</button>
</form>
</div>
@endsection