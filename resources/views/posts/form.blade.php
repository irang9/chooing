@extends('layouts.app')

@section('content')

<div class="bd-intro">
    <div class="d-md-flex align-items-center justify-content-between">
        <h1>{{ isset($post->id) ? '글 수정' : '새 글 쓰기' }} < <a href="/posts">게시판</a></h1>
    </div>
</div>

<div class="bd-content">
    <form action="{{ isset($post->id) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST">
        @csrf
        @if(isset($post->id))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label for="title" class="form-label">제목</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">내용</label>
            <div id="toolbar-container">
                <span class="ql-formats">
                    <select class="ql-size"></select>
                </span>
                <span class="ql-formats">
                    <button class="ql-bold"></button>
                    <button class="ql-italic"></button>
                    <button class="ql-underline"></button>
                    <button class="ql-strike"></button>
                </span>
                <span class="ql-formats">
                    <select class="ql-color"></select>
                    <select class="ql-background"></select>
                </span>
                <span class="ql-formats">
                    <button class="ql-script" value="sub"></button>
                    <button class="ql-script" value="super"></button>
                </span>
                <span class="ql-formats">
                    <button class="ql-header" value="1"></button>
                    <button class="ql-header" value="2"></button>
                    <button class="ql-blockquote"></button>
                    <button class="ql-code-block"></button>
                </span>
                <span class="ql-formats">
                    <button class="ql-list" value="ordered"></button>
                    <button class="ql-list" value="bullet"></button>
                    <button class="ql-indent" value="-1"></button>
                    <button class="ql-indent" value="+1"></button>
                </span>
                <span class="ql-formats">
                    <select class="ql-align"></select>
                </span>
                <span class="ql-formats">
                    <button class="ql-link"></button>
                    <button class="ql-image"></button>
                </span>
                <span class="ql-formats">
                    <button class="ql-clean"></button>
                </span>
            </div>
            <div id="editor-container" style="height: 300px;">{!! old('content', $post->content) !!}</div>
            <textarea name="content" id="content" style="display:none;">{{ old('content', $post->content) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($post->id) ? '수정 저장' : '작성 완료' }}</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">취소</a>
    </form>
</div>

<!-- Quill CSS -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />

<!-- Quill JS -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>

<!-- Initialize Quill editor -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var quill = new Quill('#editor-container', {
            modules: {
                syntax: true,
                toolbar: '#toolbar-container',
            },
            placeholder: '글을 작성해주세요...',
            theme: 'snow',
        });

        // 텍스트 영역의 내용을 Quill 에디터에 로드
        var content = document.querySelector('textarea[name=content]');
        quill.root.innerHTML = content.value;

        var form = document.querySelector('form');
        form.onsubmit = function() {
            content.value = quill.root.innerHTML;
        };
    });
</script>
@endsection